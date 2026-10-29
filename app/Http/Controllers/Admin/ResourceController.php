<?php

namespace App\Http\Controllers\Admin;

use App\Admin\FieldCodec;
use App\Admin\Registry;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ResourceController extends Controller
{
    public function index(string $resource): View
    {
        $def   = Registry::get($resource);
        $class = $def['model'];
        $items = $class::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.index', $this->viewData($resource, $def) + ['items' => $items]);
    }

    public function create(string $resource): View
    {
        $def   = Registry::get($resource);
        $class = $def['model'];

        $defaults = [];
        foreach ($def['fields'] as $f) {
            if (array_key_exists('default', $f)) {
                $defaults[$f['name']] = $f['default'];
            }
        }
        $defaults['sort_order'] = ((int) $class::max('sort_order')) + 1;

        return view('admin.form', $this->viewData($resource, $def, new $class($defaults)));
    }

    public function store(Request $request, string $resource): RedirectResponse
    {
        $def   = Registry::get($resource);
        $class = $def['model'];

        $validated = $request->validate($this->rules($def, null), [], $this->attributes($def));
        $class::create($this->payload($def, $request, $validated, null));

        return redirect()->route('admin.index', $resource)->with('status', $def['singular'] . ' created.');
    }

    public function edit(string $resource, int $id): View
    {
        $def   = Registry::get($resource);
        $class = $def['model'];

        return view('admin.form', $this->viewData($resource, $def, $class::findOrFail($id)));
    }

    public function update(Request $request, string $resource, int $id): RedirectResponse
    {
        $def   = Registry::get($resource);
        $class = $def['model'];
        $item  = $class::findOrFail($id);

        $validated = $request->validate($this->rules($def, $item), [], $this->attributes($def));
        $original  = $item->getOriginal();

        $item->update($this->payload($def, $request, $validated, $item));

        if (isset($def['after_update'])) {
            ($def['after_update'])($item, $original);
        }

        return redirect()->route('admin.index', $resource)->with('status', $def['singular'] . ' updated.');
    }

    public function destroy(string $resource, int $id): RedirectResponse
    {
        $def   = Registry::get($resource);
        $class = $def['model'];
        $item  = $class::findOrFail($id);

        if (isset($def['can_delete']) && ($message = ($def['can_delete'])($item))) {
            return back()->withErrors(['delete' => $message]);
        }

        foreach ($def['fields'] as $f) {
            if ($f['type'] === 'image') {
                $this->deleteImage($item->{$f['name']}, $f);
            }
        }

        $item->delete();

        return redirect()->route('admin.index', $resource)->with('status', $def['singular'] . ' deleted.');
    }

    // ---------------------------------------------------------------- helpers

    private function viewData(string $resource, array $def, ?Model $item = null): array
    {
        $fields = [];
        foreach ($def['fields'] as $f) {
            if ($f['type'] === 'select') {
                $f['choices'] = $this->choices($f);
            }
            $fields[$f['name']] = $f;
        }

        return ['resource' => $resource, 'def' => $def, 'fields' => $fields, 'item' => $item];
    }

    private function choices(array $f): array
    {
        $options = $f['options'] ?? [];

        return $options instanceof \Closure ? $options() : $options;
    }

    private function attributes(array $def): array
    {
        return collect($def['fields'])->pluck('label', 'name')->all();
    }

    private function rules(array $def, ?Model $item): array
    {
        $rules = [];

        foreach ($def['fields'] as $f) {
            if ($item && ! empty($f['immutable'])) {
                continue;
            }

            $rules[$f['name']] = $this->fieldRules($def, $f, $item);

            if ($f['type'] === 'image') {
                $rules['remove_' . $f['name']] = ['nullable', 'boolean'];
            }
        }

        return $rules;
    }

    private function fieldRules(array $def, array $f, ?Model $item): array
    {
        $rules = [! empty($f['required']) ? 'required' : 'nullable'];

        switch ($f['type']) {
            case 'checkbox':
                return ['nullable', 'boolean'];

            case 'image':
                return ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'];

            case 'number':
                array_push($rules, 'integer', 'min:' . ($f['min'] ?? 0), 'max:' . ($f['max'] ?? 9999));
                break;

            case 'select':
                $rules[] = Rule::in(array_keys($this->choices($f)));
                break;

            case 'url':
                array_push(
                    $rules,
                    'string',
                    'max:' . ($f['max'] ?? 255),
                    'starts_with:' . implode(',', $f['prefixes'] ?? ['http://', 'https://'])
                );
                break;

            case 'textarea':
            case 'tags':
            case 'lines':
                array_push($rules, 'string', 'max:' . ($f['max'] ?? 3000));
                break;

            default:
                array_push($rules, 'string', 'max:' . ($f['max'] ?? 255));
        }

        foreach ($f['extra_rules'] ?? [] as $extra) {
            $rules[] = $extra;
        }

        if (! empty($f['unique'])) {
            $class   = $def['model'];
            $rules[] = Rule::unique((new $class)->getTable(), $f['name'])->ignore($item?->getKey());
        }

        return $rules;
    }

    private function payload(array $def, Request $request, array $validated, ?Model $item): array
    {
        $data = [];

        foreach ($def['fields'] as $f) {
            $name = $f['name'];

            if ($item && ! empty($f['immutable'])) {
                continue;
            }

            if ($f['type'] === 'image') {
                if ($request->hasFile($name)) {
                    if ($item) {
                        $this->deleteImage($item->{$name}, $f);
                    }
                    $data[$name] = $this->storeImage($request->file($name), $f);
                } elseif ($item && $request->boolean('remove_' . $name)) {
                    $this->deleteImage($item->{$name}, $f);
                    $data[$name] = null;
                }

                continue;
            }

            $data[$name] = FieldCodec::fromForm($f['type'], $validated[$name] ?? null);
        }

        return $data;
    }

    private function storeImage(UploadedFile $file, array $f): string
    {
        $dir  = trim($f['dir'] ?? 'img/uploads', '/');
        $name = Str::uuid() . '.' . $file->extension();
        $file->move(public_path($dir), $name);

        return $dir . '/' . $name;
    }

    private function deleteImage(?string $path, array $f): void
    {
        $dir = trim($f['dir'] ?? 'img/uploads', '/');

        if ($path && str_starts_with($path, $dir . '/') && ! str_contains($path, '..') && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
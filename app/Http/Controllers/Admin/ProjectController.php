<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index', [
            'projects' => Project::ordered()->get(),
        ]);
    }

    public function create(): View
    {
        $project = new Project([
            'status'     => 'IN PROGRESS',
            'is_visible' => true,
            'sort_order' => ((int) Project::max('sort_order')) + 1,
        ]);

        return view('admin.projects.form', compact('project'));
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $data = $this->payload($request);
        $data['image'] = $this->storeImage($request);

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('status', 'Project created.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $this->payload($request);

        if ($request->hasFile('image')) {
            $this->deleteImage($project->image);
            $data['image'] = $this->storeImage($request);
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImage($project->image);
            $data['image'] = null;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('status', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteImage($project->image);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Project deleted.');
    }

    private function payload(ProjectRequest $request): array
    {
        $v = $request->validated();

        return [
            'code'       => $v['code'],
            'title'      => $v['title'],
            'status'     => $v['status'],
            'short_desc' => $v['short_desc'],
            'full_desc'  => $v['full_desc'],
            'tags'       => array_values(array_filter(array_map('trim', explode(',', $v['tags'] ?? '')))),
            'highlights' => array_values(array_filter(array_map('trim', preg_split('/\R/', $v['highlights'] ?? '')))),
            'github_url' => $v['github_url'] ?? null,
            'demo_url'   => $v['demo_url'] ?? null,
            'sort_order' => $v['sort_order'] ?? 0,
            'is_visible' => $request->boolean('is_visible'),
        ];
    }

    private function storeImage(ProjectRequest $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $name = Str::uuid() . '.' . $file->extension();
        $file->move(public_path('img/projects'), $name);

        return 'img/projects/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'img/projects/') && ! str_contains($path, '..') && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
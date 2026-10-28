<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // routes are already behind the auth middleware
    }

    public function rules(): array
    {
        $statuses = collect(config('portfolio.statuses'))->except('default')->keys()->all();

        return [
            'code'         => ['required', 'string', 'max:20', Rule::unique('projects', 'code')->ignore($this->route('project'))],
            'title'        => ['required', 'string', 'max:150'],
            'status'       => ['required', Rule::in($statuses)],
            'short_desc'   => ['required', 'string', 'max:500'],
            'full_desc'    => ['required', 'string', 'max:3000'],
            'tags'         => ['nullable', 'string', 'max:300'],
            'highlights'   => ['nullable', 'string', 'max:2000'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'github_url'   => ['nullable', 'url', 'max:255', 'starts_with:http://,https://'],
            'demo_url'     => ['nullable', 'url', 'max:255', 'starts_with:http://,https://'],
            'sort_order'   => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_visible'   => ['nullable', 'boolean'],
        ];
    }
}
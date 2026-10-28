<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categories = collect(config('portfolio.skill_categories'))
            ->pluck('id')
            ->reject(fn ($id) => $id === 'ALL')
            ->values()
            ->all();

        return [
            'name'        => ['required', 'string', 'max:100', Rule::unique('skills', 'name')->ignore($this->route('skill'))],
            'category'    => ['required', Rule::in($categories)],
            'level'       => ['required', 'integer', 'min:0', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_visible'  => ['nullable', 'boolean'],
        ];
    }
}
@extends('admin.layout')
@section('title', $skill->exists ? 'Edit skill' : 'New skill')

@section('content')
@php
    $input      = 'w-full border border-slate-300 rounded px-3 py-2 text-sm bg-white focus:outline-none focus:border-[#1d6cd8]';
    $label      = 'block text-xs font-bold uppercase mb-1';
    $categories = collect(config('portfolio.skill_categories'))->reject(fn ($c) => $c['id'] === 'ALL');
    $visible    = old() ? old('is_visible') : $skill->is_visible;
@endphp

<h1 class="text-xl font-black uppercase mb-4">{{ $skill->exists ? 'Edit skill' : 'New skill' }}</h1>

<form method="POST"
      action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}"
      class="bg-white border border-slate-300 rounded-lg p-5 space-y-4">
    @csrf
    @if ($skill->exists)
        @method('PUT')
    @endif

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="{{ $label }}">Name</label>
            <input id="name" name="name" value="{{ old('name', $skill->name) }}" required class="{{ $input }}">
            @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="category" class="{{ $label }}">Category</label>
            <select id="category" name="category" class="{{ $input }}">
                @foreach ($categories as $c)
                    <option value="{{ $c['id'] }}" @selected(old('category', $skill->category) === $c['id'])>{{ $c['label'] }}</option>
                @endforeach
            </select>
            @error('category')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <label for="level" class="{{ $label }}">Level (0–100)</label>
            <input id="level" type="number" min="0" max="100" name="level" value="{{ old('level', $skill->level) }}" required class="{{ $input }}">
            @error('level')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="sort_order" class="{{ $label }}">Order (lower shows first)</label>
            <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}" class="{{ $input }}">
            @error('sort_order')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-2 text-sm pb-2">
                <input type="checkbox" name="is_visible" value="1" @checked($visible)> Show on site
            </label>
        </div>
    </div>

    <div>
        <label for="description" class="{{ $label }}">Description</label>
        <input id="description" name="description" value="{{ old('description', $skill->description) }}" required class="{{ $input }}">
        @error('description')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button class="px-5 py-2 bg-[#1d6cd8] text-white text-sm font-bold uppercase rounded hover:opacity-90">Save</button>
        <a href="{{ route('admin.skills.index') }}" class="text-sm text-slate-500 hover:text-slate-800">Cancel</a>
    </div>
</form>
@endsection
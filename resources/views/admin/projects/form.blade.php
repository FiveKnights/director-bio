@extends('admin.layout')
@section('title', $project->exists ? 'Edit project' : 'New project')

@section('content')
@php
    $input    = 'w-full border border-slate-300 rounded px-3 py-2 text-sm bg-white focus:outline-none focus:border-[#1d6cd8]';
    $label    = 'block text-xs font-bold uppercase mb-1';
    $statuses = collect(config('portfolio.statuses'))->except('default')->keys();
    $visible  = old() ? old('is_visible') : $project->is_visible;
@endphp

<h1 class="text-xl font-black uppercase mb-4">{{ $project->exists ? 'Edit project' : 'New project' }}</h1>

<form method="POST" enctype="multipart/form-data"
      action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
      class="bg-white border border-slate-300 rounded-lg p-5 space-y-4">
    @csrf
    @if ($project->exists)
        @method('PUT')
    @endif

    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <label for="code" class="{{ $label }}">Code</label>
            <input id="code" name="code" value="{{ old('code', $project->code) }}" placeholder="OP-03" required class="{{ $input }}">
            @error('code')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-2">
            <label for="title" class="{{ $label }}">Title</label>
            <input id="title" name="title" value="{{ old('title', $project->title) }}" required class="{{ $input }}">
            @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <label for="status" class="{{ $label }}">Status</label>
            <select id="status" name="status" class="{{ $input }}">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status', $project->status) === $status)>{{ $status }}</option>
                @endforeach
            </select>
            @error('status')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="sort_order" class="{{ $label }}">Order (lower shows first)</label>
            <input id="sort_order" type="number" min="0" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="{{ $input }}">
            @error('sort_order')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-2 text-sm pb-2">
                <input type="checkbox" name="is_visible" value="1" @checked($visible)> Show on site
            </label>
        </div>
    </div>

    <div>
        <label for="short_desc" class="{{ $label }}">Short description (card)</label>
        <textarea id="short_desc" name="short_desc" rows="2" required class="{{ $input }}">{{ old('short_desc', $project->short_desc) }}</textarea>
        @error('short_desc')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="full_desc" class="{{ $label }}">Full description (popup)</label>
        <textarea id="full_desc" name="full_desc" rows="4" required class="{{ $input }}">{{ old('full_desc', $project->full_desc) }}</textarea>
        @error('full_desc')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="tags" class="{{ $label }}">Tags (comma-separated)</label>
        <input id="tags" name="tags" value="{{ old('tags', implode(', ', $project->tags ?? [])) }}" placeholder="Laravel, MySQL, ESP32" class="{{ $input }}">
        @error('tags')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="highlights" class="{{ $label }}">Key highlights (one per line)</label>
        <textarea id="highlights" name="highlights" rows="4" class="{{ $input }}">{{ old('highlights', implode("\n", $project->highlights ?? [])) }}</textarea>
        @error('highlights')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label for="github_url" class="{{ $label }}">GitHub URL</label>
            <input id="github_url" type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/..." class="{{ $input }}">
            @error('github_url')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="demo_url" class="{{ $label }}">Live demo URL</label>
            <input id="demo_url" type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" placeholder="https://..." class="{{ $input }}">
            @error('demo_url')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="image" class="{{ $label }}">Screenshot (JPG, PNG or WebP, max 2 MB)</label>
        @if ($project->image)
            <div class="flex items-center gap-3 mb-2">
                <img src="{{ asset($project->image) }}" alt="" class="w-28 h-16 object-cover rounded border border-slate-200">
                <label class="text-sm flex items-center gap-2">
                    <input type="checkbox" name="remove_image" value="1"> Remove current image
                </label>
            </div>
        @endif
        <input id="image" type="file" name="image" accept="image/*" class="text-sm">
        @error('image')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button class="px-5 py-2 bg-[#1d6cd8] text-white text-sm font-bold uppercase rounded hover:opacity-90">Save</button>
        <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-500 hover:text-slate-800">Cancel</a>
    </div>
</form>
@endsection
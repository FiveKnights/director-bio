@extends('admin.layout')
@section('title', 'Projects')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-black uppercase">Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-[#1d6cd8] text-white text-sm font-bold uppercase rounded hover:opacity-90">+ New project</a>
</div>

<div class="bg-white border border-slate-300 rounded-lg overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
            <tr>
                <th class="p-3">Image</th>
                <th class="p-3">Code</th>
                <th class="p-3">Title</th>
                <th class="p-3">Status</th>
                <th class="p-3">Order</th>
                <th class="p-3">Visible</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr class="border-t border-slate-200">
                    <td class="p-3">
                        @if ($project->image)
                            <img src="{{ asset($project->image) }}" alt="" class="w-16 h-10 object-cover rounded border border-slate-200">
                        @endif
                    </td>
                    <td class="p-3 font-mono">{{ $project->code }}</td>
                    <td class="p-3 font-bold">{{ $project->title }}</td>
                    <td class="p-3">{{ $project->status }}</td>
                    <td class="p-3">{{ $project->sort_order }}</td>
                    <td class="p-3">{{ $project->is_visible ? 'Yes' : 'Hidden' }}</td>
                    <td class="p-3 whitespace-nowrap text-right">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-[#1d6cd8] font-bold">Edit</a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline"
                              onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button class="ml-3 text-red-600 font-bold">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="p-6 text-center text-slate-500">No projects yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
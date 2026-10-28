@extends('admin.layout')
@section('title', 'Skills')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-black uppercase">Skills</h1>
    <a href="{{ route('admin.skills.create') }}" class="px-4 py-2 bg-[#1d6cd8] text-white text-sm font-bold uppercase rounded hover:opacity-90">+ New skill</a>
</div>

<div class="bg-white border border-slate-300 rounded-lg overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
            <tr>
                <th class="p-3">Name</th>
                <th class="p-3">Category</th>
                <th class="p-3">Level</th>
                <th class="p-3">Order</th>
                <th class="p-3">Visible</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($skills as $skill)
                <tr class="border-t border-slate-200">
                    <td class="p-3 font-bold">{{ $skill->name }}</td>
                    <td class="p-3">{{ $skill->category }}</td>
                    <td class="p-3">{{ $skill->level }}%</td>
                    <td class="p-3">{{ $skill->sort_order }}</td>
                    <td class="p-3">{{ $skill->is_visible ? 'Yes' : 'Hidden' }}</td>
                    <td class="p-3 whitespace-nowrap text-right">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="text-[#1d6cd8] font-bold">Edit</a>
                        <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="inline"
                              onsubmit="return confirm('Delete this skill?')">
                            @csrf
                            @method('DELETE')
                            <button class="ml-3 text-red-600 font-bold">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="p-6 text-center text-slate-500">No skills yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
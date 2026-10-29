@extends('admin.layout')

@section('title', 'Control Panel')

@section('content')
<div class="space-y-6">
    <div class="border-b border-slate-300 pb-2">
        <span class="text-xs font-tech text-[#1d6cd8] font-bold uppercase tracking-widest">// OVERVIEW</span>
        <h2 class="text-xl font-black text-slate-800 uppercase">CONTROL PANEL</h2>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($resources as $key => $section)
            <a href="{{ route('admin.index', $key) }}"
               class="group bg-white/90 backdrop-blur-md border border-slate-300 hover:border-[#1d6cd8] p-5 shadow-sm rounded-lg transition-all">
                <span class="text-[10px] font-tech text-[#1d6cd8] font-bold uppercase tracking-widest">// {{ $section['hint'] }}</span>
                <h3 class="text-lg font-black text-slate-800 uppercase group-hover:text-[#1d6cd8] transition-colors">{{ $section['label'] }}</h3>
                <p class="mt-1 font-tech text-xs text-slate-500">{{ $section['model']::count() }} RECORDS</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
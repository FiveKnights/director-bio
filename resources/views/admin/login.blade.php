@extends('admin.layout')

@section('title', 'Authorization')

@section('content')
<div class="max-w-md mx-auto mt-6 md:mt-20">
    <div class="bg-white/90 backdrop-blur-md border-2 border-[#1d6cd8] p-6 md:p-8 shadow-lg clip-corner-tr">

        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 bg-[#1d6cd8] flex items-center justify-center shrink-0 clip-corner-tr">
                <svg viewBox="0 0 100 100" class="w-8 h-8 text-white fill-current">
                    <path d="M 20,50 L 50,20 L 50,80 Z" opacity="0.9" />
                    <path d="M 52,10 L 62,10 L 62,90 L 52,90 Z" />
                    <path d="M 64,20 L 90,50 L 64,80 Z" opacity="0.9" />
                </svg>
            </div>
            <div>
                <div class="font-tech text-[11px] text-[#1d6cd8] font-bold tracking-wider">// RESTRICTED CONSOLE</div>
                <h1 class="text-xl font-black text-slate-800 tracking-wider uppercase leading-none mt-0.5">AUTHORIZATION</h1>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block font-tech text-[11px] font-bold uppercase tracking-widest text-slate-500 mb-1">OPERATOR EMAIL</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full font-tech text-sm border border-slate-300 bg-white px-3 py-2.5 focus:outline-none focus:border-[#1d6cd8]">
                @error('email')<p class="mt-1 font-tech text-[11px] text-[#ef4444]">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password" class="block font-tech text-[11px] font-bold uppercase tracking-widest text-slate-500 mb-1">ACCESS CODE</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full font-tech text-sm border border-slate-300 bg-white px-3 py-2.5 focus:outline-none focus:border-[#1d6cd8]">
            </div>

            <label class="flex items-center gap-2 font-tech text-xs font-bold uppercase text-slate-600">
                <input type="checkbox" name="remember" value="1" class="w-4 h-4 accent-[#1d6cd8]"> KEEP SESSION ACTIVE
            </label>

            <button class="w-full py-3 bg-[#1d6cd8] text-white font-tech font-bold text-sm tracking-widest uppercase clip-button hover:opacity-90 transition-opacity">
                AUTHENTICATE
            </button>
        </form>

        <p class="mt-5 font-tech text-[10px] text-slate-400 uppercase tracking-widest">UNAUTHORIZED ACCESS IS LOGGED</p>
    </div>
</div>
@endsection
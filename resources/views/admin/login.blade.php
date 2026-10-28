@extends('admin.layout')
@section('title', 'Log in')

@section('content')
<div class="max-w-sm mx-auto mt-16 bg-white border border-slate-300 rounded-lg p-6">
    <h1 class="text-xl font-black uppercase mb-4">Admin log in</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-xs font-bold uppercase mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-[#1d6cd8]">
            @error('email')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="password" class="block text-xs font-bold uppercase mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-[#1d6cd8]">
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember" value="1"> Remember me
        </label>

        <button class="w-full py-2.5 bg-[#1d6cd8] text-white font-bold uppercase text-sm rounded hover:opacity-90">Log in</button>
    </form>
</div>
@endsection
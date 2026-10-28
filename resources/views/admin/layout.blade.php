<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') // Portfolio Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen">
    @auth
        <header class="bg-white border-b border-slate-300">
            <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between gap-4 flex-wrap">
                <nav class="flex items-center gap-5 text-sm font-bold uppercase tracking-wide">
                    <a href="{{ route('admin.projects.index') }}" class="hover:text-[#1d6cd8]">Projects</a>
                    <a href="{{ route('admin.skills.index') }}" class="hover:text-[#1d6cd8]">Skills</a>
                    <a href="{{ route('portfolio') }}" target="_blank" class="text-slate-500 hover:text-[#1d6cd8]">View site ↗</a>
                </nav>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="text-sm font-bold uppercase text-slate-500 hover:text-red-600">Log out</button>
                </form>
            </div>
        </header>
    @endauth

    <main class="max-w-5xl mx-auto px-4 py-6">
        @if (session('status'))
            <div class="mb-4 px-4 py-3 text-sm bg-green-50 text-green-800 border border-green-200 rounded">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
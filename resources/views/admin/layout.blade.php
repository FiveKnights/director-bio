<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Console') // ADMIN CONSOLE</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen relative overflow-x-hidden p-4 md:p-8">
    @include('portfolio.partials.background')

    <div class="relative z-20 max-w-6xl mx-auto">

        @auth
            @php $current = request()->route('resource'); @endphp

            <header class="mb-6 bg-white/90 backdrop-blur-md border-2 border-[#1d6cd8] p-4 shadow-md clip-corner-tr">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-[#1d6cd8] flex items-center justify-center shrink-0 shadow-sm clip-corner-tr">
                            <svg viewBox="0 0 100 100" class="w-8 h-8 text-white fill-current">
                                <path d="M 20,50 L 50,20 L 50,80 Z" opacity="0.9" />
                                <path d="M 52,10 L 62,10 L 62,90 L 52,90 Z" />
                                <path d="M 64,20 L 90,50 L 64,80 Z" opacity="0.9" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2 font-tech text-[11px] text-[#1d6cd8] font-bold tracking-wider">
                                <span class="w-2 h-2 bg-[#10b981] rounded-full animate-pulse"></span>
                                <span>OPERATOR: {{ strtoupper(auth()->user()->name) }}</span>
                                <span class="text-slate-400">//</span>
                                <span class="text-slate-500">SECURE SESSION</span>
                            </div>
                            <h1 class="text-lg md:text-xl font-black text-slate-800 tracking-wider uppercase leading-none mt-0.5">ADMIN CONSOLE</h1>
                        </div>
                    </a>

                    <div class="flex flex-wrap items-center gap-2.5 font-tech text-xs">
                        <a href="{{ route('portfolio') }}" target="_blank" rel="noopener"
                           class="px-3 py-1 bg-slate-100 hover:bg-slate-200 border border-slate-300 text-slate-700 font-bold">VIEW SITE ↗</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="px-3 py-1 bg-[#ef4444]/10 hover:bg-[#ef4444]/20 border border-[#ef4444]/30 text-[#ef4444] font-bold">LOG OUT</button>
                        </form>
                    </div>
                </div>

                <nav class="mt-4 pt-3 border-t border-slate-300 flex flex-wrap gap-2 font-tech text-xs font-bold uppercase">
                    @foreach (\App\Admin\Registry::all() as $key => $section)
                        <a href="{{ route('admin.index', $key) }}"
                           class="px-3 py-1.5 border transition-colors {{ $current === $key ? 'bg-[#1d6cd8] text-white border-[#1d6cd8]' : 'bg-slate-100 text-slate-700 border-slate-300 hover:border-[#1d6cd8] hover:text-[#1d6cd8]' }}">
                            [{{ strtoupper($section['label']) }}]
                        </a>
                    @endforeach
                </nav>
            </header>
        @endauth

        @if (session('status'))
            <div class="mb-6 px-4 py-3 font-tech text-xs font-bold uppercase tracking-wider bg-[#10b981]/10 text-[#10b981] border border-[#10b981]/30">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
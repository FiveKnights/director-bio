<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="portfolioTerminal()"
      x-init="startClock(); startAutoLogin(); initKeys()"
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('portfolio.seo.title'))</title>
<meta name="description" content="{{ config('portfolio.seo.description') }}">
<meta name="theme-color" content="#f1f5f9">
<link rel="canonical" href="{{ url('/') }}">

<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

<!-- Link previews (Facebook, LinkedIn, WhatsApp, Discord, X) -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('portfolio.seo.title') }}">
<meta property="og:title" content="{{ config('portfolio.seo.title') }}">
<meta property="og:description" content="{{ config('portfolio.seo.description') }}">
<meta property="og:url" content="{{ url('/') }}">
@if (config('portfolio.seo.image'))
    <meta property="og:image" content="{{ asset(config('portfolio.seo.image')) }}">
    <meta name="twitter:card" content="summary_large_image">
@else
    <meta name="twitter:card" content="summary">
@endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Rajdhani:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body class="bg-slate-100 dark:bg-[#090d16] text-slate-800 dark:text-slate-100 font-sans min-h-screen flex flex-col justify-between relative overflow-x-hidden transition-colors duration-300 p-4 md:p-8">

    @yield('content')

    @stack('scripts')
</body>
</html>

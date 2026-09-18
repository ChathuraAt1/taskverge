<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Error') - {{ config('app.name', 'TaskVerge') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex flex-col justify-between bg-slate-950 font-sans relative overflow-x-hidden">
    <!-- Background Ambient Glow -->
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 h-[500px] w-[700px] rounded-full bg-emerald-500/10 blur-[130px]"></div>
        <div class="absolute bottom-0 right-10 h-[350px] w-[500px] rounded-full bg-teal-500/5 blur-[120px]"></div>
    </div>

    <!-- Header -->
    <header class="border-b border-slate-800/80 bg-slate-950/60 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.webp') }}" alt="TaskVerge" class="h-9 w-auto object-contain brightness-110">
            </a>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 px-3.5 py-1.5 text-xs font-semibold text-slate-200 transition-colors">
                        Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="rounded-xl bg-emerald-600 hover:bg-emerald-500 px-3.5 py-1.5 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Error Content Container -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-xl text-center space-y-6">
            <!-- Icon & Code Badge -->
            <div class="flex flex-col items-center gap-3">
                <div class="h-16 w-16 rounded-2xl @yield('badge_bg', 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400') flex items-center justify-center shadow-lg">
                    @yield('icon')
                </div>
                <div class="inline-flex items-center gap-2 rounded-full border border-slate-800 bg-slate-900/90 px-3.5 py-1 text-xs font-mono font-bold tracking-wider uppercase text-slate-300">
                    <span class="h-1.5 w-1.5 rounded-full @yield('dot_color', 'bg-emerald-400')"></span>
                    <span>HTTP @yield('code') &bull; @yield('status')</span>
                </div>
            </div>

            <!-- Title & Description -->
            <div class="space-y-2">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    @yield('heading')
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 max-w-md mx-auto leading-relaxed">
                    @yield('message')
                </p>
            </div>

            <!-- Actions Row -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                @yield('actions')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-950/80 py-4 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} TaskVerge Autonomous Intelligence Network. All rights reserved.</p>
    </footer>
</body>
</html>

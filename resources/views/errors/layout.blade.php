<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Error') - {{ config('app.name', 'TaskVerge') }}</title>

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
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 text-white shadow-md shadow-emerald-500/20">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-white">Task<span class="text-emerald-400">Verge</span></span>
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskVerge') }} - Enterprise Workflow Intelligence</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full flex flex-col bg-slate-950 font-sans">
    <!-- Enterprise Navigation Header -->
    <header class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Task<span class="text-indigo-400">Verge</span></span>
                </a>
                <span class="ml-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-2 py-0.5 text-xs font-semibold text-indigo-400">Enterprise</span>
            </div>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                <a href="{{ route('home') }}#overview" class="hover:text-white transition-colors">Overview</a>
                <a href="{{ route('home') }}#architecture" class="hover:text-white transition-colors">Architecture</a>
                <a href="{{ route('home') }}#nvidia-foundation" class="hover:text-white transition-colors flex items-center gap-1.5">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-400"></span>
                    NVIDIA Tech Showcase
                </a>
                <a href="{{ route('home') }}#governance" class="hover:text-white transition-colors">Governance</a>
                <a href="{{ route('home') }}#deployment" class="hover:text-white transition-colors">Deployment</a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 transition-colors">
                        Launch Console
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Log In</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 transition-colors">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Enterprise Global Footer -->
    <footer class="border-t border-slate-800 bg-slate-950 py-12 text-slate-400">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                <div class="space-y-4">
                    <div class="flex items-center gap-2.5">
                        <div class="flex h-7 w-7 items-center justify-center rounded-md bg-indigo-600 text-white font-bold text-xs">
                            TV
                        </div>
                        <span class="text-lg font-bold text-white tracking-tight">Task<span class="text-indigo-400">Verge</span></span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Enterprise Workflow Intelligence platform for orchestrating mission-critical operations, cross-functional dependencies, and real-time status traceability.
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Enterprise Core</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}#overview" class="hover:text-white transition-colors">Workflow Automation</a></li>
                        <li><a href="{{ route('home') }}#architecture" class="hover:text-white transition-colors">System Architecture</a></li>
                        <li><a href="{{ route('home') }}#governance" class="hover:text-white transition-colors">SOC2 & ISO Governance</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Operator Workspace</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Technology Foundation</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}#nvidia-foundation" class="hover:text-white transition-colors flex items-center gap-1.5"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> NVIDIA NeMo Workflows</a></li>
                        <li><a href="{{ route('home') }}#nvidia-foundation" class="hover:text-white transition-colors flex items-center gap-1.5"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> NVIDIA Nemotron Reasoning</a></li>
                        <li><a href="{{ route('home') }}#nvidia-foundation" class="hover:text-white transition-colors flex items-center gap-1.5"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> NVIDIA NIM Microservices</a></li>
                        <li><a href="{{ route('home') }}#nvidia-foundation" class="hover:text-white transition-colors flex items-center gap-1.5"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> NVIDIA Triton Serving</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Connect & Channels</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors inline-flex items-center gap-2">
                                <svg class="h-4 w-4 fill-currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                GitHub Organization
                            </a>
                        </li>
                        <li>
                            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors inline-flex items-center gap-2">
                                <svg class="h-4 w-4 fill-currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76c.92 0 1.66-.74 1.66-1.66a1.66 1.66 0 0 0-3.32 0c0 .92.74 1.66 1.66 1.66m1.39 9.74v-8.37H5.07v8.37h2.78z"/></svg>
                                LinkedIn Enterprise
                            </a>
                        </li>
                        <li>
                            <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors inline-flex items-center gap-2">
                                <svg class="h-4 w-4 fill-currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                X / Twitter Operations
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-900 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} TaskVerge Technologies Inc. All rights reserved. Enterprise Workflow Intelligence System.</p>
                <div class="flex gap-4 mt-4 sm:mt-0">
                    <span class="hover:text-slate-400 cursor-pointer">Security Whitepaper</span>
                    <span class="hover:text-slate-400 cursor-pointer">API Specification</span>
                    <span class="hover:text-slate-400 cursor-pointer">Privacy & Telemetry</span>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>

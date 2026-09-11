<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-900 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Workspace' }} - {{ config('app.name', 'TaskVerge') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full flex overflow-hidden bg-slate-900 font-sans" x-data="{ sidebarOpen: false, userDropdownOpen: false }">
    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-slate-950/80 backdrop-blur-sm lg:hidden" 
         style="display: none;"></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 z-50 w-72 flex-col justify-between border-r border-slate-800 bg-slate-950 px-5 py-6 transition-transform duration-300 ease-in-out lg:static lg:flex">
        <div class="flex flex-col gap-6">
            <!-- Brand -->
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white shadow-md shadow-indigo-500/20">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold tracking-tight text-white">Task<span class="text-indigo-400">Verge</span></span>
                        <p class="text-[10px] tracking-wider uppercase font-semibold text-slate-400">Workflow Intelligence</p>
                    </div>
                </a>

                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Role Badge Banner -->
            <div class="rounded-lg border border-slate-800 bg-slate-900/60 p-3">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-400">Active Role</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold uppercase tracking-wider
                        {{ auth()->user()->isAdmin() ? 'bg-purple-500/20 text-purple-300 border border-purple-500/30' : (auth()->user()->isManager() ? 'bg-indigo-500/20 text-indigo-300 border border-indigo-500/30' : 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30') }}">
                        {{ auth()->user()->role }}
                    </span>
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <img class="h-6 w-6 rounded-full object-cover" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                    <div class="truncate text-xs font-medium text-slate-200">{{ auth()->user()->name }}</div>
                </div>
                <div class="text-[11px] text-slate-400 mt-0.5 truncate">{{ auth()->user()->department ?? 'General' }}</div>
            </div>

            <!-- Main Nav -->
            <nav class="flex flex-col gap-1 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.25 2.25L18 6" />
                    </svg>
                    Operational Dashboard
                </a>

                <a href="{{ route('workflows.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('workflows.*') ? 'bg-indigo-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-6A1.125 1.125 0 012.25 9.375v-2.25zM2.25 14.625c0-.621.504-1.125 1.125-1.125h6c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-2.25zM13.5 7.125c0-.621.504-1.125 1.125-1.125h6c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-6A1.125 1.125 0 0113.5 9.375v-2.25zM13.5 14.625c0-.621.504-1.125 1.125-1.125h6c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                    </svg>
                    Workflows & Projects
                </a>

                <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2 transition-colors {{ request()->routeIs('tasks.*') ? 'bg-indigo-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>
                    Master Task Registry
                </a>

                <div class="my-2 border-t border-slate-800"></div>

                <!-- Starred Workflows Quick Links -->
                <div class="px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                    Active Pipelines
                </div>
                @php
                    $starredWorkflows = \App\Models\Workflow::query()->take(4)->get();
                @endphp
                @foreach($starredWorkflows as $swf)
                    <a href="{{ route('workflows.show', $swf) }}" class="flex items-center justify-between rounded-lg px-3 py-1.5 text-xs text-slate-400 hover:bg-slate-900 hover:text-white transition-colors truncate">
                        <span class="truncate flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-{{ $swf->color }}-500"></span>
                            {{ $swf->title }}
                        </span>
                        <span class="rounded bg-slate-800 px-1.5 py-0.5 text-[10px] font-mono text-slate-300">
                            {{ $swf->tasks()->count() }}
                        </span>
                    </a>
                @endforeach
            </nav>
        </div>

        <!-- Quick Switch Persona for Demo / Evaluation -->
        <div class="border-t border-slate-800 pt-4">
            <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Evaluation Persona Switch</p>
            <div class="flex flex-col gap-1.5">
                @php
                    $demoAccounts = \App\Models\User::query()->whereIn('email', ['admin@taskverge.com', 'manager@taskverge.com', 'operator@taskverge.com'])->get();
                @endphp
                @foreach($demoAccounts as $acc)
                    @if($acc->id !== auth()->id())
                        <form method="POST" action="{{ route('quick-login', $acc) }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-between rounded-md bg-slate-900/80 px-2.5 py-1.5 text-xs text-slate-300 hover:bg-indigo-600 hover:text-white transition-colors">
                                <span class="truncate">{{ $acc->name }}</span>
                                <span class="text-[10px] uppercase font-mono tracking-wider opacity-75">({{ $acc->role }})</span>
                            </button>
                        </form>
                    @endif
                @endforeach
            </div>

            <div class="mt-4 pt-3 border-t border-slate-800/80 flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-white flex items-center gap-1.5">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Landing Page
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 font-medium">Sign Out</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex flex-1 flex-col overflow-hidden">
        <!-- Top App Bar -->
        <header class="flex h-16 items-center justify-between border-b border-slate-800 bg-slate-950/80 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-bold text-white tracking-tight">{{ $header ?? 'TaskVerge Operational Intelligence' }}</h1>
            </div>

            <div class="flex items-center gap-3">
                <!-- NVIDIA AI Intelligence Badge -->
                <div class="hidden sm:flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3 py-1 text-xs text-emerald-400">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="font-medium">NVIDIA Triton & Nemotron Active</span>
                </div>

                <!-- User profile drop -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 rounded-lg border border-slate-800 bg-slate-900 px-3 py-1.5 text-xs text-slate-200 hover:bg-slate-800">
                        <img class="h-5 w-5 rounded-full object-cover" src="{{ auth()->user()->avatar }}" alt="">
                        <span class="font-medium truncate max-w-[120px]">{{ auth()->user()->name }}</span>
                        <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-52 rounded-lg border border-slate-800 bg-slate-950 p-2 shadow-xl z-50" style="display: none;">
                        <div class="px-3 py-2 border-b border-slate-800 text-xs">
                            <div class="font-semibold text-white">{{ auth()->user()->name }}</div>
                            <div class="text-slate-400 truncate">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left rounded px-3 py-1.5 text-xs text-rose-400 hover:bg-rose-500/10 transition-colors">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Status Notification Banner -->
        @if (session('status'))
            <div class="bg-indigo-600/90 text-white px-4 py-2 text-xs font-medium flex items-center justify-between">
                <span>{{ session('status') }}</span>
                <button onclick="this.parentElement.remove()" class="text-white/80 hover:text-white">&times;</button>
            </div>
        @endif

        <!-- Page View Body -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-slate-900/60">
            @yield('content')
            {{ $slot ?? '' }}
        </main>
    </div>

    @livewireScripts
</body>
</html>

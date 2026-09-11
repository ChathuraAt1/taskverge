<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-white scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskVerge') }} - Autonomous Task & Workflow Intelligence</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full flex flex-col bg-slate-950 font-sans">
    <!-- Clean, Modern Commercial Header -->
    <header class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/90 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-white">Task<span class="text-emerald-400">Verge</span></span>
                </a>
            </div>

            @php
                $navItems = [
                    ['id' => 'about', 'label' => 'About Us'],
                    ['id' => 'what-it-does', 'label' => 'Capabilities'],
                    ['id' => 'how-it-works', 'label' => 'How It Works'],
                    ['id' => 'testimonials', 'label' => 'Stories'],
                    ['id' => 'benefits', 'label' => 'Benefits'],
                    ['id' => 'why-different', 'label' => 'Why TaskVerge'],
                    ['id' => 'pricing', 'label' => 'Pricing'],
                    ['id' => 'contact', 'label' => 'Contact'],
                ];
            @endphp
            <nav 
                x-data="{
                    activeSection: '',
                    init() {
                        if (window.location.hash) {
                            this.activeSection = window.location.hash.replace('#', '');
                        }
                        const sections = ['about', 'what-it-does', 'how-it-works', 'testimonials', 'benefits', 'why-different', 'pricing', 'contact'];
                        
                        const updateActive = () => {
                            const scrollPos = window.scrollY + 220;
                            let current = '';
                            for (let i = sections.length - 1; i >= 0; i--) {
                                const el = document.getElementById(sections[i]);
                                if (el && el.offsetTop <= scrollPos) {
                                    current = sections[i];
                                    break;
                                }
                            }
                            if (window.scrollY < 180 && !window.location.hash) {
                                current = '';
                            }
                            if (current) {
                                this.activeSection = current;
                            }
                        };
                        
                        window.addEventListener('scroll', updateActive, { passive: true });
                        this.$nextTick(updateActive);
                    }
                }"
                class="hidden md:flex items-center gap-1 lg:gap-1.5 text-xs lg:text-sm font-medium text-slate-300"
            >
                @foreach($navItems as $item)
                    <a 
                        href="{{ route('home') }}#{{ $item['id'] }}" 
                        @click="activeSection = '{{ $item['id'] }}'"
                        :class="activeSection === '{{ $item['id'] }}' 
                            ? 'text-white font-semibold shadow-sm' 
                            : 'text-slate-300 hover:text-white hover:bg-slate-900/40'"
                        class="relative px-3 py-1.5 rounded-full transition-all duration-300 group overflow-hidden"
                    >
                        <!-- Radial green gradient from link middle fading to transparent at the ends -->
                        <span 
                            x-show="activeSection === '{{ $item['id'] }}'"
                            x-cloak
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90"
                            class="absolute inset-0 pointer-events-none rounded-full"
                            style="background: radial-gradient(circle at center, rgba(16, 185, 129, 0.45) 0%, rgba(16, 185, 129, 0.22) 40%, rgba(5, 150, 105, 0.08) 70%, transparent 100%); border: 1px solid rgba(16, 185, 129, 0.35); box-shadow: 0 0 16px rgba(16, 185, 129, 0.25);"
                        ></span>
                        <span class="relative z-10">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-500 transition-all">
                        <span>Go to Dashboard</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white transition-colors px-2 py-1">Log In</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-500 transition-all">
                        Try It Free
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Minimalist Dark Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-950 py-10 text-slate-400">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 pb-8 border-b border-slate-900">
                <!-- Brand, Mission & Contact Badge -->
                <div class="space-y-3 max-w-md">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                            <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>
                            </div>
                            <span class="text-lg font-extrabold tracking-tight text-white">Task<span class="text-emerald-400">Verge</span></span>
                        </a>
                        <div class="h-4 w-px bg-slate-800"></div>
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-0.5 text-[11px] font-medium text-emerald-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Operational
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Autonomous workflow intelligence designed to triage, predict bottlenecks, and keep teams moving forward.
                    </p>
                    <div class="flex flex-wrap items-center gap-3 pt-1 text-xs">
                        <a href="mailto:help@taskverge.net" class="inline-flex items-center gap-1.5 text-slate-300 hover:text-emerald-400 transition-colors font-medium">
                            <svg class="h-3.5 w-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span>help@taskverge.net</span>
                        </a>
                        <span class="text-slate-700">•</span>
                        <span class="text-slate-400">San Francisco HQ</span>
                        <span class="text-slate-700">•</span>
                        <span class="text-slate-400">London Hub</span>
                    </div>
                </div>

                <!-- Navigation Anchors & Social Links -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-6 lg:gap-10">
                    <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs font-medium text-slate-400">
                        <a href="{{ route('home') }}#what-it-does" class="hover:text-white transition-colors">Capabilities</a>
                        <a href="{{ route('home') }}#how-it-works" class="hover:text-white transition-colors">How It Works</a>
                        <a href="{{ route('home') }}#testimonials" class="hover:text-white transition-colors">Stories</a>
                        <a href="{{ route('home') }}#benefits" class="hover:text-white transition-colors">Benefits</a>
                        <a href="{{ route('home') }}#why-different" class="hover:text-white transition-colors">Why TaskVerge</a>
                        <a href="{{ route('home') }}#pricing" class="hover:text-white transition-colors">Pricing</a>
                        <a href="{{ route('home') }}#contact" class="text-emerald-400 hover:text-emerald-300 transition-colors">Contact</a>
                    </nav>

                    <div class="flex items-center gap-3 text-slate-400">
                        <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-800 bg-slate-900/60 hover:bg-slate-800 hover:text-white transition-all" title="GitHub">
                            <svg class="h-4 w-4 fill-currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-800 bg-slate-900/60 hover:bg-slate-800 hover:text-white transition-all" title="LinkedIn">
                            <svg class="h-4 w-4 fill-currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76c.92 0 1.66-.74 1.66-1.66a1.66 1.66 0 0 0-3.32 0c0 .92.74 1.66 1.66 1.66m1.39 9.74v-8.37H5.07v8.37h2.78z"/></svg>
                        </a>
                        <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-800 bg-slate-900/60 hover:bg-slate-800 hover:text-white transition-all" title="X (Twitter)">
                            <svg class="h-4 w-4 fill-currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Sub-bar: Copyright & Legal -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} TaskVerge Inc. All rights reserved.</p>
                <div class="flex flex-wrap items-center gap-6">
                    <a href="{{ route('home') }}#contact" class="hover:text-slate-400 transition-colors">Support & Inquiries</a>
                    <span class="hover:text-slate-400 cursor-pointer transition-colors">Privacy Policy</span>
                    <span class="hover:text-slate-400 cursor-pointer transition-colors">Terms of Service</span>
                    <span class="hover:text-slate-400 cursor-pointer transition-colors">Security</span>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>

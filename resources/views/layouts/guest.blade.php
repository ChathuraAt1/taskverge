<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-white scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TaskVerge') }} - Autonomous Task & Workflow Intelligence</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                    ['id' => 'what-it-does', 'label' => 'Capabilities'],
                    ['id' => 'how-it-works', 'label' => 'How It Works'],
                    ['id' => 'testimonials', 'label' => 'Stories'],
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
                        const sections = ['what-it-does', 'how-it-works', 'testimonials', 'benefits', 'why-different', 'pricing', 'contact'];
                        
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
                            if (current === 'benefits') {
                                current = 'why-different';
                            }
                            if (current) {
                                this.activeSection = current;
                            }
                        };
                        
                        window.addEventListener('scroll', updateActive, { passive: true });
                        this.$nextTick(updateActive);
                    }
                }"
                class="hidden md:flex items-center gap-1.5 lg:gap-2 text-xs lg:text-sm font-medium text-slate-300"
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
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-700 bg-slate-800/90 px-3 py-1.5 text-xs font-semibold text-slate-200 hover:bg-slate-700 hover:text-white transition-all shadow-sm">
                        <span>Dashboard</span>
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                @endauth
                <a href="{{ route('product') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 px-4 py-2 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-500/25 hover:from-emerald-400 hover:to-teal-500 transition-all hover:scale-[1.02]">
                    <span>Cortex™ Engine</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
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
                        <a href="https://medium.com/@taskverg" target="_blank" rel="noopener noreferrer" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-800 bg-slate-900/60 hover:bg-slate-800 hover:text-white transition-all text-sm" title="Medium">
                            <i class="fa-brands fa-medium"></i>
                        </a>
                        <a href="https://www.youtube.com/@Taskverge" target="_blank" rel="noopener noreferrer" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-800 bg-slate-900/60 hover:bg-slate-800 hover:text-white transition-all text-sm" title="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="https://www.facebook.com/taskverge/" target="_blank" rel="noopener noreferrer" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-800 bg-slate-900/60 hover:bg-slate-800 hover:text-white transition-all text-sm" title="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
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

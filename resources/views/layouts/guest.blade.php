<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-white scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $canonicalPath = match (true) {
            request()->routeIs('home') => '/',
            request()->routeIs('product') => '/product',
            request()->routeIs('privacy') => '/privacy',
            request()->routeIs('terms') => '/terms',
            default => null,
        };
        $canonicalUrl = $canonicalPath !== null
            ? rtrim(config('app.url'), '/') . $canonicalPath
            : null;
    @endphp
    @if ($canonicalUrl)
        <link rel="canonical" href="{{ $canonicalUrl }}">
    @else
        <meta name="robots" content="noindex,follow">
    @endif

    <title>{{ config('app.name', 'TaskVerge') }} - Autonomous Task & Workflow Intelligence</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full flex flex-col bg-slate-950 font-sans">
    <!-- Clean, Modern Commercial Header -->
    <header class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-950/90 backdrop-blur-md"
            x-data="{ mobileMenuOpen: false }"
            @keydown.escape.window="mobileMenuOpen = false">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-8 min-h-16 py-2">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5 group">
                <img src="{{ asset('images/logo.webp') }}" alt="TaskVerge" class="h-9 w-auto object-contain brightness-110 group-hover:scale-105 transition-transform">
            </a>

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
                        if (window.location.hash) this.activeSection = window.location.hash.slice(1);
                        const sections = ['what-it-does', 'how-it-works', 'testimonials', 'benefits', 'why-different', 'pricing', 'contact'];
                        const updateActive = () => {
                            const scrollPos = window.scrollY + 220;
                            let current = '';
                            for (let i = sections.length - 1; i >= 0; i--) {
                                const el = document.getElementById(sections[i]);
                                if (el && el.offsetTop <= scrollPos) { current = sections[i]; break; }
                            }
                            if (window.scrollY < 180 && !window.location.hash) current = '';
                            this.activeSection = current === 'benefits' ? 'why-different' : current;
                        };
                        window.addEventListener('scroll', updateActive, { passive: true });
                        this.$nextTick(updateActive);
                    }
                }"
                class="hidden lg:flex items-center gap-0.5 xl:gap-1 text-xs xl:text-sm font-medium text-slate-300"
                aria-label="Main navigation">
                @foreach($navItems as $item)
                    <a href="{{ route('home') }}#{{ $item['id'] }}"
                       @click="activeSection = '{{ $item['id'] }}'"
                       :class="activeSection === '{{ $item['id'] }}' ? 'text-white font-semibold shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-900/40'"
                       class="relative whitespace-nowrap px-2 xl:px-2.5 py-1.5 rounded-full transition-all duration-300">
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="ml-auto flex shrink-0 items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex items-center gap-1.5 rounded-lg border border-slate-700 bg-slate-800/90 px-3 py-1.5 text-xs font-semibold text-slate-200 hover:bg-slate-700 hover:text-white transition-all shadow-sm">
                        <span>Dashboard</span>
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </a>
                @endauth
                <a href="{{ route('product') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 px-3 sm:px-4 py-2 text-xs sm:text-sm font-bold text-white shadow-md shadow-emerald-500/25 hover:from-emerald-400 hover:to-teal-500 transition-all">
                    <span>Cortex™ Engine</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
                <button type="button"
                        class="lg:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-700 bg-slate-900 text-slate-200 hover:bg-slate-800"
                        aria-controls="mobile-site-navigation"
                        :aria-expanded="mobileMenuOpen.toString()"
                        :aria-label="mobileMenuOpen ? 'Close navigation menu' : 'Open navigation menu'"
                        @click="mobileMenuOpen = !mobileMenuOpen">
                    <svg x-show="!mobileMenuOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    <svg x-cloak x-show="mobileMenuOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>

        <nav id="mobile-site-navigation"
             x-cloak
             x-show="mobileMenuOpen"
             x-transition
             class="lg:hidden border-t border-slate-800 bg-slate-950 px-4 py-3 sm:px-6"
             aria-label="Mobile navigation">
            <div class="mx-auto grid max-w-7xl grid-cols-2 gap-2 sm:grid-cols-3">
                @foreach($navItems as $item)
                    <a href="{{ route('home') }}#{{ $item['id'] }}"
                       @click="mobileMenuOpen = false"
                       class="rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 hover:bg-slate-900 hover:text-white">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
            @auth
                <a href="{{ route('dashboard') }}" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex rounded-lg px-3 py-2.5 text-sm font-semibold text-emerald-300 hover:bg-slate-900 sm:hidden">Open Dashboard</a>
            @endauth
        </nav>
    </header>

    <main class="flex-1">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Minimalist Dark Footer -->
    <footer id="site-footer" class="border-t border-slate-800/80 bg-slate-950 py-10 text-slate-400">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 pb-8 border-b border-slate-900">
                <!-- Brand, Mission & Contact Badge -->
                <div class="space-y-3 max-w-md">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                            <img src="{{ asset('images/logo.webp') }}" alt="TaskVerge" class="h-8 w-auto object-contain brightness-110 group-hover:scale-105 transition-transform">
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
                        <span class="text-slate-400">Head Office: Taskverge PVT LTD (Sri Lanka)</span>
                        <span class="text-slate-700">•</span>
                        <span class="text-slate-400">USA Branch: Taskverge LLC</span>
                    </div>
                    <!-- Company profile section -->
                    <div class="flex items-center gap-4">
                        <a href="https://www.f6s.com/taskverge" target="_blank" class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-400 transition-colors text-xs">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            <p>F6S</p>
                        </a>
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        <a href="https://www.crunchbase.com/organization/taskverge" target="_blank" class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-400 transition-colors text-xs">
                            <p>Crunchbase</p>
                        </a>
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    </div>
                </div>

                <!-- Navigation Anchors & Social Links -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-6 lg:gap-10">
                    <nav class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs font-medium text-slate-400">
                        <a href="{{ route('home') }}#what-it-does" class="hover:text-white transition-colors">Capabilities</a>
                        <a href="{{ route('home') }}#how-it-works" class="hover:text-white transition-colors">How It Works</a>
                        <a href="{{ route('home') }}#testimonials" class="hover:text-white transition-colors">Stories</a>
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
                        <a href="https://www.linkedin.com/company/taskverge1" target="_blank" rel="noopener noreferrer" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-800 bg-slate-900/60 hover:bg-slate-800 hover:text-white transition-all text-sm" title="LinkedIn">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Sub-bar: Copyright & Legal -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} Taskverge LLC &amp; Taskverge PVT LTD. All rights reserved.</p>
                <div class="flex flex-wrap items-center gap-6">
                    <a href="{{ route('home') }}#contact" class="hover:text-slate-400 transition-colors">Support & Inquiries</a>
                    <a href="{{ route('privacy') }}" class="hover:text-slate-400 transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-slate-400 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global AI Assistant Chatbot (Floating Bottom-Right) -->
    <livewire:landing-chatbot />

    <!-- Global Cookie Consent Dialog Box (Floating Bottom-Left) -->
    <x-cookie-consent />

    @livewireScripts
</body>
</html>


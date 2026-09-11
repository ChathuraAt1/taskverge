@extends('layouts.guest')

@section('content')
<div class="space-y-36 sm:space-y-48 lg:space-y-56 pb-36 overflow-hidden">
    <!-- 1. HERO SECTION: Full Viewport Height Screen with Autonomous Neural Telemetry Showcase -->
    <section class="relative min-h-[calc(100vh-4rem)] flex flex-col justify-center px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto py-12 lg:py-16">
        <!-- Ambient Neural Glow Spheres -->
        <div class="absolute -top-24 left-1/4 -translate-x-1/2 w-[650px] h-[450px] bg-emerald-500/15 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="absolute top-1/3 right-10 w-[550px] h-[400px] bg-teal-500/15 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="relative z-10 max-w-5xl mx-auto text-center my-auto pt-4 sm:pt-8 w-full">
            <!-- Centered Main Headline -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.12] max-w-4xl mx-auto">
                Workflows that triage, assign, and <br class="hidden sm:inline">
                <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">unblock themselves.</span>
            </h1>

            <!-- High-Impact Action CTAs (Directly Under Headline) -->
            <div class="flex flex-wrap items-center justify-center gap-3.5 pt-8">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2.5 rounded-xl bg-emerald-600 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-emerald-600/30 hover:bg-emerald-500 transition-all scale-100 hover:scale-[1.02]">
                        <span>Open Your Dashboard</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2.5 rounded-xl bg-emerald-600 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-emerald-600/30 hover:bg-emerald-500 transition-all scale-100 hover:scale-[1.02]">
                        <span>Start Free 14-Day Trial</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-900/90 px-5 py-3.5 text-sm font-semibold text-slate-200 hover:bg-slate-800 hover:text-white transition-all">
                        <span>Explore Live Personas</span>
                    </a>
                @endauth
                <a href="#what-it-does" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-800/80 bg-slate-950/60 px-4 py-3.5 text-sm font-semibold text-slate-400 hover:text-white hover:border-slate-700 transition-all">
                    <span>Capabilities &darr;</span>
                </a>
            </div>

            <!-- Animated Small Metrics Pills -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-7 pb-2">
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-slate-900/90 px-3.5 py-1.5 backdrop-blur-md shadow-md shadow-emerald-950/40 transition-all hover:scale-105 hover:border-emerald-400/60">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-bold text-emerald-400">-84%</span>
                    <span class="text-xs text-slate-300">Status Meeting Drag</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-full border border-teal-500/30 bg-slate-900/90 px-3.5 py-1.5 backdrop-blur-md shadow-md shadow-teal-950/40 transition-all hover:scale-105 hover:border-teal-400/60">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75" style="animation-delay: 350ms"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-400"></span>
                    </span>
                    <span class="text-xs font-bold text-teal-300">99.4%</span>
                    <span class="text-xs text-slate-300">Autonomous Triage</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-full border border-cyan-500/30 bg-slate-900/90 px-3.5 py-1.5 backdrop-blur-md shadow-md shadow-cyan-950/40 transition-all hover:scale-105 hover:border-cyan-400/60">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75" style="animation-delay: 700ms"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-400"></span>
                    </span>
                    <span class="text-xs font-bold text-cyan-300">&lt; 2 min</span>
                    <span class="text-xs text-slate-300">Instant Setup</span>
                </div>
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-slate-900/80 px-3.5 py-1.5 backdrop-blur-md transition-all hover:scale-105">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-medium text-emerald-300">Zero-Touch Resolution</span>
                </div>
            </div>

            <!-- Bottom Image Area with Fixed State for Scrolling (Stock Image) -->
            <div class="relative mx-auto mt-8 sm:mt-10 max-w-5xl w-full rounded-2xl sm:rounded-3xl border border-emerald-500/25 bg-slate-950/80 p-2 sm:p-3 shadow-2xl shadow-emerald-950/50 backdrop-blur-xl">
                <!-- Browser-like Top Chrome Bar -->
                <div class="flex items-center justify-between px-3 py-2 border-b border-slate-800/80 bg-slate-900/90 rounded-t-xl mb-2 text-xs">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1.5">
                            <span class="h-2.5 w-2.5 rounded-full bg-rose-500/80"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-amber-500/80"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-emerald-500/80"></span>
                        </div>
                        <span class="ml-2 font-mono text-[11px] text-slate-400">TaskVerge Platform &bull; Autonomous Workspace</span>
                    </div>
                    <div class="hidden sm:flex items-center gap-2 text-[11px] text-slate-400 font-mono">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Live Telemetry Active</span>
                    </div>
                </div>

                <!-- Viewport Area with Fixed Scrolling State -->
                <div class="relative h-48 sm:h-64 md:h-72 w-full rounded-xl overflow-hidden border border-slate-800/70 bg-slate-900 bg-center bg-cover bg-no-repeat sm:bg-fixed"
                     style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=2000&q=80');">
                    <!-- Subtle Dark Gradient Overlays for contrast and blend -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute inset-0 bg-emerald-950/15 mix-blend-multiply pointer-events-none"></div>

                    <!-- Bottom floating status overlay inside viewport -->
                    <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-xs text-white">
                        <div class="flex items-center gap-2 bg-slate-950/80 backdrop-blur-md px-3 py-1.5 rounded-lg border border-slate-800/80">
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                            <span class="font-medium text-slate-200">Neural Flow Engine v2.4</span>
                        </div>
                        <div class="hidden sm:flex items-center gap-2 bg-slate-950/80 backdrop-blur-md px-3 py-1.5 rounded-lg border border-slate-800/80 text-emerald-300 font-mono text-[11px]">
                            <span>All 12 Squads Synchronized</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. ABOUT US: Asymmetric Editorial Split (No Box Grids) -->
    <section id="about" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="rounded-3xl border border-slate-800 bg-gradient-to-b from-slate-900/80 to-slate-950 p-8 sm:p-12 lg:p-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Visual Editorial Column -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-800 shadow-2xl aspect-[4/3] sm:aspect-square">
                        <img 
                            src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=900&q=80" 
                            alt="Team leaders reviewing project strategy in an office" 
                            class="w-full h-full object-cover object-center filter brightness-90"
                            loading="lazy"
                        />
                        <div class="absolute inset-0 bg-emerald-950/20 mix-blend-multiply"></div>
                        <!-- Floating Glass Metric Card -->
                        <div class="absolute bottom-5 left-5 right-5 p-4 rounded-xl bg-slate-950/90 backdrop-blur-md border border-slate-800 text-xs shadow-xl">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-bold text-white">Built for High-Velocity Modern Teams</span>
                                <span class="text-emerald-400 font-mono text-[11px]">TaskVerge Engine</span>
                            </div>
                            <div class="text-slate-400 text-[11px]">From agile engineering squads to complex multi-department operations.</div>
                        </div>
                    </div>
                </div>

                <!-- Editorial Narrative Column -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">About Us</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                            Work management built to eliminate manual babysitting.
                        </h2>
                    </div>

                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed">
                        Traditional boards are static graveyards requiring endless status checks. <strong>TaskVerge</strong> operates silently alongside your team—balancing capacity, predicting deadlines 48 hours early, and auto-resolving blockers so work never stalls.
                    </p>

                    <!-- Punchy Key Pillars -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-2.5 rounded-xl border border-slate-800/80 bg-slate-950/60 p-3 text-xs text-slate-300">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 shrink-0"></span>
                            <span><strong>Zero Status Chasing:</strong> Live bandwidth matching.</span>
                        </div>
                        <div class="flex items-center gap-2.5 rounded-xl border border-slate-800/80 bg-slate-950/60 p-3 text-xs text-slate-300">
                            <span class="h-2 w-2 rounded-full bg-teal-400 shrink-0"></span>
                            <span><strong>Predictive Sentry:</strong> Early warning before delays.</span>
                        </div>
                    </div>

                    <!-- Contrast Strip: The Old Way vs The TaskVerge Way -->
                    <div class="pt-3 border-t border-slate-800 space-y-2.5">
                        <div class="flex items-center gap-3 text-xs">
                            <span class="rounded bg-rose-500/10 text-rose-400 border border-rose-500/20 px-2 py-0.5 font-bold uppercase shrink-0">The Old Way</span>
                            <span class="text-slate-400">Hours lost to "what's the status?" syncs and forgotten tickets.</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs">
                            <span class="rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-0.5 font-bold uppercase shrink-0">The TaskVerge Way</span>
                            <span class="text-slate-200 font-medium">Autonomous triaging, real-time risk radar, and 1-click unblocking.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. WHAT IT DOES: Fluid Morphing Layout with Full-Section Moving Gradient & Fixed Expand Modal Overlay -->
    <section id="what-it-does" class="relative px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">What It Does</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Everything You Need to Keep Work Moving</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Simple, intuitive workflow tools that eliminate status chasing and keep everyone aligned.</p>
        </div>

        <!-- Interactive Morphing Component with Alpine.js -->
        <div 
            x-data="{
                state: 0,
                expandedIndex: null,
                isPaused: false,
                progress: 0,
                direction: 1,
                intervalMs: 5000,
                stepMs: 50,
                init() {
                    setInterval(() => {
                        if (!this.isPaused && this.expandedIndex === null) {
                            this.progress += (this.stepMs / this.intervalMs) * 100;
                            if (this.progress >= 100) {
                                this.progress = 0;
                                this.state = (this.state + 1) % 3;
                                this.direction = this.direction === 1 ? -1 : 1;
                            }
                        }
                    }, this.stepMs);
                },
                pause() {
                    this.isPaused = true;
                },
                resume() {
                    this.isPaused = false;
                },
                toggleExpand(idx) {
                    this.expandedIndex = idx;
                }
            }"
            @mouseenter="pause()"
            @mouseleave="resume()"
            class="relative rounded-3xl sm:rounded-[2.5rem] border border-emerald-500/20 bg-slate-950/90 p-4 sm:p-6 lg:p-8 shadow-2xl overflow-hidden"
        >
            <!-- Visible Full-Height Background Filling Animation Div with Proper Padding -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl sm:rounded-[2.5rem]">
                <!-- Rich Gradient Base Layer -->
                <div 
                    class="absolute inset-0 bg-gradient-to-r from-emerald-950/50 via-teal-900/40 to-cyan-950/50 transition-transform"
                    :style="{
                        transform: direction === 1 
                            ? 'translateX(' + (-40 + (progress * 0.4)) + '%)' 
                            : 'translateX(' + (0 - (progress * 0.4)) + '%)',
                        transition: isPaused ? 'none' : 'transform 60ms linear'
                    }"
                ></div>

                <!-- Prominent Moving Glowing Wave (Sweeps Left to Right and Right to Left) -->
                <div 
                    class="absolute -top-1/4 -bottom-1/4 w-[45%] bg-gradient-to-r from-transparent via-emerald-400/25 via-teal-300/30 to-transparent blur-3xl transition-all"
                    :style="{
                        left: direction === 1 
                            ? (progress * 1.1 - 25) + '%' 
                            : ((100 - progress) * 1.1 - 25) + '%',
                        transition: isPaused ? 'none' : 'left 60ms linear'
                    }"
                ></div>

                <!-- Glowing Ambient Accent Strip -->
                <div 
                    class="absolute top-0 bottom-0 w-1.5 bg-gradient-to-b from-emerald-400 via-teal-300 to-transparent blur-sm opacity-60 transition-all"
                    :style="{
                        left: direction === 1 
                            ? (progress * 1.05 - 5) + '%' 
                            : ((100 - progress) * 1.05 - 5) + '%',
                        transition: isPaused ? 'none' : 'left 60ms linear'
                    }"
                ></div>

                <!-- Subtle Dot Texture Overlay -->
                <div class="absolute inset-0 bg-[radial-gradient(#10b981_1.5px,transparent_1.5px)] [background-size:24px_24px] opacity-20"></div>

                <!-- Glowing Inner Edge Highlight -->
                <div class="absolute inset-0 rounded-3xl sm:rounded-[2.5rem] border border-emerald-500/20 pointer-events-none"></div>
            </div>

            <!-- Fluid Morphing Grid Layout: Row 1 & Row 2 (Positioned on top of animated background with proper padding) -->
            <div class="space-y-6 relative z-10">
                <!-- ROW 1: Smart Work Balancing + Stock Image Showcase -->
                <div class="flex flex-col md:flex-row gap-6 items-stretch w-full">
                    
                    <!-- Block 0: Smart Work Distribution -->
                    <div 
                        :class="state === 0 ? 'w-full md:w-[60%]' : (state === 1 ? 'w-full md:w-[42%]' : 'w-full md:w-[66%]')"
                        class="group relative rounded-3xl border border-slate-800 bg-slate-950/90 backdrop-blur-md p-6 sm:p-8 flex flex-col justify-between hover:border-emerald-500/50 transition-all duration-1000 ease-in-out shadow-xl overflow-hidden min-h-[300px]"
                    >
                        <div class="flex items-center justify-between mb-4">
                            <div class="inline-flex items-center gap-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-3 py-1.5 text-xs font-semibold text-emerald-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <span>Work Distribution</span>
                            </div>
                            <!-- Hover-Appearing Expand Button -->
                            <button 
                                @click.stop="toggleExpand(0)"
                                class="opacity-0 group-hover:opacity-100 transition-all duration-300 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-700 bg-slate-900/90 text-xs font-medium text-slate-300 hover:text-white hover:border-emerald-500/50 hover:bg-emerald-950/50 shadow-lg backdrop-blur-sm"
                            >
                                <span>Expand View</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-3 transition-opacity duration-500">
                            <h3 class="text-xl sm:text-2xl font-bold text-white group-hover:text-emerald-300 transition-colors">
                                Smart Work Balancing
                            </h3>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                Assigns tasks automatically based on who has the time and skills. Work gets started faster, handoffs happen naturally, and no team member is overloaded.
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-800/80 flex flex-wrap items-center gap-2 text-xs">
                            <span class="rounded-lg bg-slate-900/90 border border-slate-800 px-3 py-1.5 text-slate-300">
                                Launch Campaign &rarr; <strong class="text-emerald-400">Auto-Assigned to Design</strong>
                            </span>
                            <span class="rounded-lg bg-slate-900/90 border border-slate-800 px-3 py-1.5 text-slate-300">
                                Client Review &rarr; <strong class="text-teal-400">Auto-Assigned to Accounts</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Block 1: Stock Image Showcase (Visual Collaboration Area) -->
                    <div 
                        :class="state === 0 ? 'w-full md:w-[40%]' : (state === 1 ? 'w-full md:w-[58%]' : 'w-full md:w-[34%]')"
                        class="group relative rounded-3xl border border-slate-800 bg-slate-950 overflow-hidden flex flex-col justify-between hover:border-emerald-500/50 transition-all duration-1000 ease-in-out shadow-xl min-h-[300px]"
                    >
                        <img 
                            src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80" 
                            alt="Creative team collaborating happily around workspace" 
                            class="absolute inset-0 w-full h-full object-cover object-center filter brightness-75 group-hover:scale-105 group-hover:brightness-90 transition-all duration-1000"
                            loading="lazy"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-slate-950/20"></div>
                        <div class="absolute inset-0 bg-emerald-950/20 mix-blend-multiply pointer-events-none"></div>

                        <div class="relative z-10 p-6 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-950/80 backdrop-blur-md border border-slate-700 px-3 py-1 text-xs font-semibold text-emerald-300">
                                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                Team Hub
                            </span>
                            <button 
                                @click.stop="toggleExpand(1)"
                                class="opacity-0 group-hover:opacity-100 transition-all duration-300 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-700 bg-slate-950/90 text-xs font-medium text-slate-300 hover:text-white hover:border-emerald-500/50 shadow-md backdrop-blur-sm"
                            >
                                <span>Expand View</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </button>
                        </div>

                        <div class="relative z-10 p-6 mt-auto">
                            <h4 class="text-lg sm:text-xl font-bold text-white drop-shadow-md">
                                Built for Teams That Deliver
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-200 mt-1 drop-shadow-md">
                                Keep everyone connected in one clean place without endless meetings.
                            </p>
                        </div>
                    </div>

                </div>

                <!-- ROW 2: Roadblock Clearing + Team Visibility -->
                <div class="flex flex-col md:flex-row gap-6 items-stretch w-full">
                    
                    <!-- Block 2: Roadblock Clearing -->
                    <div 
                        :class="state === 0 ? 'w-full md:w-[38%]' : (state === 1 ? 'w-full md:w-[62%]' : 'w-full md:w-[50%]')"
                        class="group relative rounded-3xl border border-slate-800 bg-slate-950/90 backdrop-blur-md p-6 sm:p-8 flex flex-col justify-between hover:border-emerald-500/50 transition-all duration-1000 ease-in-out shadow-xl overflow-hidden min-h-[290px]"
                    >
                        <div class="flex items-center justify-between mb-4">
                            <div class="inline-flex items-center gap-2 rounded-xl bg-teal-500/10 border border-teal-500/20 px-3 py-1.5 text-xs font-semibold text-teal-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span>Blocker Prevention</span>
                            </div>
                            <button 
                                @click.stop="toggleExpand(2)"
                                class="opacity-0 group-hover:opacity-100 transition-all duration-300 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-700 bg-slate-900/90 text-xs font-medium text-slate-300 hover:text-white hover:border-emerald-500/50 hover:bg-emerald-950/50 shadow-md backdrop-blur-sm"
                            >
                                <span>Expand View</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-3 transition-opacity duration-500">
                            <h3 class="text-xl sm:text-2xl font-bold text-white group-hover:text-teal-300 transition-colors">
                                Instant Roadblock Clearing
                            </h3>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                When work gets delayed waiting on approvals or feedback, TaskVerge spots the holdup immediately and gives you 1-click ways to unblock it.
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Waiting for approval?</span>
                            <span class="inline-flex items-center gap-1 font-semibold text-emerald-400">
                                &check; 1-Click Unblock Ready
                            </span>
                        </div>
                    </div>

                    <!-- Block 3: Progress Transparency -->
                    <div 
                        :class="state === 0 ? 'w-full md:w-[62%]' : (state === 1 ? 'w-full md:w-[38%]' : 'w-full md:w-[50%]')"
                        class="group relative rounded-3xl border border-slate-800 bg-slate-950/90 backdrop-blur-md p-6 sm:p-8 flex flex-col justify-between hover:border-emerald-500/50 transition-all duration-1000 ease-in-out shadow-xl overflow-hidden min-h-[290px]"
                    >
                        <div class="flex items-center justify-between mb-4">
                            <div class="inline-flex items-center gap-2 rounded-xl bg-teal-500/10 border border-teal-500/20 px-3 py-1.5 text-xs font-semibold text-teal-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Live Visibility</span>
                            </div>
                            <button 
                                @click.stop="toggleExpand(3)"
                                class="opacity-0 group-hover:opacity-100 transition-all duration-300 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-700 bg-slate-900/90 text-xs font-medium text-slate-300 hover:text-white hover:border-emerald-500/50 hover:bg-emerald-950/50 shadow-md backdrop-blur-sm"
                            >
                                <span>Expand View</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-3 transition-opacity duration-500">
                            <h3 class="text-xl sm:text-2xl font-bold text-white group-hover:text-teal-300 transition-colors">
                                Effortless Team Visibility
                            </h3>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                See how every project is progressing in real time. Know what’s finished, what’s active, and what needs attention without sending a single status email.
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Status meetings eliminated</span>
                            <a href="{{ route('register') }}" class="font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">
                                Explore Workflows &rarr;
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Fixed Position Modal Overlay for Expanded View (Overlays screen without breaking grid layout) -->
            <div 
                x-show="expandedIndex !== null" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @keydown.escape.window="expandedIndex = null"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-10 bg-slate-950/80 backdrop-blur-xl"
                style="display: none;"
            >
                <div 
                    @click.outside="expandedIndex = null"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="relative w-full max-w-3xl max-h-[85vh] overflow-y-auto rounded-3xl border border-emerald-500/30 bg-slate-950 p-6 sm:p-10 shadow-2xl shadow-emerald-950/60"
                >
                    <!-- Modal Header: Top Status + Close Button -->
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-800">
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-300">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Expanded Focus View
                        </span>
                        <button 
                            @click="expandedIndex = null"
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-700 bg-slate-900 text-xs font-semibold text-slate-300 hover:text-white hover:border-emerald-500/50 hover:bg-emerald-950/40 transition-all shadow-md"
                        >
                            <span>Close</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content 0: Smart Work Distribution -->
                    <template x-if="expandedIndex === 0">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Smart Work Balancing & Distribution</h3>
                                <p class="text-sm sm:text-base text-slate-300 mt-2 leading-relaxed">
                                    Traditional teams waste hours debating who should take on new tasks, leading to uneven workloads and missed deadlines. TaskVerge routes every deliverable to the right person instantly based on real-time availability and individual strengths.
                                </p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-emerald-400 text-sm">Skill-to-Task Match</div>
                                    <div class="text-xs text-slate-400 mt-1">Direct assignment to team members with the right domain expertise.</div>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-teal-400 text-sm">Burnout Prevention</div>
                                    <div class="text-xs text-slate-400 mt-1">Balances work so no individual is overloaded while others have capacity.</div>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-cyan-400 text-sm">Zero Delay Handoffs</div>
                                    <div class="text-xs text-slate-400 mt-1">Completing a step automatically notifies and dispatches the next person.</div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Modal Content 1: Visual Collaboration Workspace Image -->
                    <template x-if="expandedIndex === 1">
                        <div class="space-y-6">
                            <div class="relative rounded-2xl overflow-hidden aspect-video border border-slate-800 shadow-xl">
                                <img 
                                    src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80" 
                                    alt="Creative team collaborating happily around workspace" 
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">Connected Team Workspace</h3>
                                <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                                    A single shared home where designers, engineers, and project leads collaborate with total clarity. No disconnected chat channels or scattered spreadsheets—just continuous, frictionless progress.
                                </p>
                            </div>
                        </div>
                    </template>

                    <!-- Modal Content 2: Roadblock Prevention -->
                    <template x-if="expandedIndex === 2">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Instant Roadblock Clearing</h3>
                                <p class="text-sm sm:text-base text-slate-300 mt-2 leading-relaxed">
                                    Projects rarely fail from lack of effort—they fail from tasks sitting in queue waiting for feedback or sign-offs. TaskVerge proactively spots delays and empowers managers and contributors to resolve them with 1 click.
                                </p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-teal-400 text-sm">Proactive Warning</div>
                                    <div class="text-xs text-slate-400 mt-1">Detects sluggish reviews before deadlines are in jeopardy.</div>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-emerald-400 text-sm">1-Click Unblock</div>
                                    <div class="text-xs text-slate-400 mt-1">Instantly reassign stalled tasks or prompt alternate reviewers.</div>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-teal-400 text-sm">Action History</div>
                                    <div class="text-xs text-slate-400 mt-1">Logs why blockers occurred to prevent similar delays in future sprints.</div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Modal Content 3: Progress Transparency -->
                    <template x-if="expandedIndex === 3">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Effortless Team Transparency</h3>
                                <p class="text-sm sm:text-base text-slate-300 mt-2 leading-relaxed">
                                    Give leaders and stakeholders total confidence without dragging creators into daily status calls. Every milestone, deliverable, and handover is visible in real-time.
                                </p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-teal-400 text-sm">Live Project Health</div>
                                    <div class="text-xs text-slate-400 mt-1">Know what is active, blocked, and done in one glance.</div>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-emerald-400 text-sm">No Standup Fatigue</div>
                                    <div class="text-xs text-slate-400 mt-1">Save hours every week by replacing status meetings with live insight.</div>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-800 bg-slate-900/70">
                                    <div class="font-bold text-cyan-400 text-sm">Shared Truth</div>
                                    <div class="text-xs text-slate-400 mt-1">One clear source of truth for both leadership and execution squads.</div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="mt-8 pt-6 border-t border-slate-800 flex justify-end">
                        <button 
                            @click="expandedIndex = null"
                            class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs transition-colors shadow-lg shadow-emerald-600/30"
                        >
                            Done Reading
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 4. HOW IT WORKS: Continuous Circuit Conduit (With Full-Section Atmospheric Background Stock Image & Ambient Glows) -->
    <section id="how-it-works" class="relative px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto overflow-hidden py-16 rounded-3xl">
        <!-- Full-Section Atmospheric Background Stock Image & Radial Glows -->
        <div class="absolute inset-0 -z-10 pointer-events-none overflow-hidden rounded-3xl">
            <img 
                src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=2000&q=80" 
                alt="Connected Circuit Workflow" 
                class="w-full h-full object-cover opacity-30 filter saturate-150 contrast-125 brightness-110"
                loading="lazy"
            />
            <!-- Smooth gradient vignettes blending into dark page body without artificial square grids -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/40 to-slate-950/95"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-transparent to-slate-950/90"></div>

            <!-- Ambient Emerald & Teal Radial Glow Orbs -->
            <div class="absolute top-1/4 left-1/4 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/20 rounded-full blur-[130px]"></div>
            <div class="absolute bottom-1/4 right-1/4 translate-y-1/2 w-[500px] h-[500px] bg-teal-500/20 rounded-full blur-[130px]"></div>
        </div>

        <div class="text-center max-w-3xl mx-auto mb-16 relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Step-by-Step</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">How It Works: In 4 Simple Steps</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">From initial task creation to completed deliverable without the usual bottlenecks.</p>
        </div>

        <!-- Central Stage Flow -->
        <div class="relative z-10">
            <!-- Glowing desktop horizontal conduit line -->
            <div class="hidden lg:block absolute top-[110px] left-10 right-10 h-1 bg-gradient-to-r from-emerald-500/40 via-teal-400 to-cyan-500/40 z-0 shadow-[0_0_16px_rgba(16,185,129,0.5)] opacity-80 rounded-full"></div>

            <!-- 4 Step Cards (Fixed height h-[320px] with pre-allocated description space to prevent any height jumping) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
                <!-- Step 1 -->
                <div class="group relative rounded-2xl border border-slate-700/60 bg-slate-900/80 hover:bg-slate-900/95 hover:border-emerald-400/80 backdrop-blur-xl p-6 sm:p-7 flex flex-col justify-between transition-all duration-300 shadow-2xl h-[320px] overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="h-12 w-12 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-extrabold text-base flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                            01
                        </span>
                        <span class="text-xs font-mono font-semibold text-emerald-400/90 group-hover:text-emerald-300 transition-colors">Phase 1</span>
                    </div>

                    <!-- Stable Text Block: Moves slightly upward on hover, description smoothly fades in into allocated space -->
                    <div class="relative transition-transform duration-300 ease-out group-hover:-translate-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-white group-hover:text-emerald-300 transition-colors duration-200">
                            Connect Workflows
                        </h3>
                        <!-- Resting subtitle chip -->
                        <div class="text-xs font-medium text-slate-400 mt-1 transition-opacity duration-200 group-hover:text-slate-300">
                            2-min visual setup
                        </div>
                        <!-- Description with smooth opacity fade within allocated space (no height jumping) -->
                        <div class="pt-3">
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-out line-clamp-3">
                                Set up your team projects in minutes using intuitive templates or custom multi-stage Kanban pipelines.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="group relative rounded-2xl border border-slate-700/60 bg-slate-900/80 hover:bg-slate-900/95 hover:border-emerald-400/80 backdrop-blur-xl p-6 sm:p-7 flex flex-col justify-between transition-all duration-300 shadow-2xl h-[320px] overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="h-12 w-12 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-extrabold text-base flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                            02
                        </span>
                        <span class="text-xs font-mono font-semibold text-emerald-400/90 group-hover:text-emerald-300 transition-colors">Phase 2</span>
                    </div>

                    <div class="relative transition-transform duration-300 ease-out group-hover:-translate-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-white group-hover:text-emerald-300 transition-colors duration-200">
                            Smart Assignment
                        </h3>
                        <div class="text-xs font-medium text-slate-400 mt-1 transition-opacity duration-200 group-hover:text-slate-300">
                            Capacity balanced
                        </div>
                        <div class="pt-3">
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-out line-clamp-3">
                                Work is automatically paired with team availability so tasks start without delay and without overburdening members.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="group relative rounded-2xl border border-slate-700/60 bg-slate-900/80 hover:bg-slate-900/95 hover:border-emerald-400/80 backdrop-blur-xl p-6 sm:p-7 flex flex-col justify-between transition-all duration-300 shadow-2xl h-[320px] overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="h-12 w-12 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-extrabold text-base flex items-center justify-center shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                            03
                        </span>
                        <span class="text-xs font-mono font-semibold text-emerald-400/90 group-hover:text-emerald-300 transition-colors">Phase 3</span>
                    </div>

                    <div class="relative transition-transform duration-300 ease-out group-hover:-translate-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-white group-hover:text-emerald-300 transition-colors duration-200">
                            Stay Ahead of Delays
                        </h3>
                        <div class="text-xs font-medium text-slate-400 mt-1 transition-opacity duration-200 group-hover:text-slate-300">
                            Proactive alerts
                        </div>
                        <div class="pt-3">
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-out line-clamp-3">
                                Get early warnings 48 hours in advance if approvals slow down before deadlines are in danger.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="group relative rounded-2xl border border-slate-700/60 bg-slate-900/80 hover:bg-slate-900/95 hover:border-teal-400/80 backdrop-blur-xl p-6 sm:p-7 flex flex-col justify-between transition-all duration-300 shadow-2xl h-[320px] overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="h-12 w-12 rounded-2xl bg-gradient-to-tr from-teal-600 to-cyan-600 text-white font-extrabold text-base flex items-center justify-center shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform duration-300">
                            04
                        </span>
                        <span class="text-xs font-mono font-semibold text-teal-400/90 group-hover:text-teal-300 transition-colors">Phase 4</span>
                    </div>

                    <div class="relative transition-transform duration-300 ease-out group-hover:-translate-y-2">
                        <h3 class="text-lg sm:text-xl font-bold text-white group-hover:text-teal-300 transition-colors duration-200">
                            Clear the Finish Line
                        </h3>
                        <div class="text-xs font-medium text-slate-400 mt-1 transition-opacity duration-200 group-hover:text-slate-300">
                            1-click resolution
                        </div>
                        <div class="pt-3">
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-out line-clamp-3">
                                Resolve roadblocks with 1-click unblock actions and keep deliverables moving cleanly to completion.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. CREATIVE TESTIMONIALS: Interactive Spotlight Stage with Multi-Story Sidebar & Tooltips -->
    <section id="testimonials" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Customer Stories</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Loved by Teams Who Value Clarity</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">See how leaders in operations, engineering, and studios eliminated project clutter.</p>
        </div>

        <!-- Interactive Testimonials Container with Alpine.js -->
        <div 
            x-data="{
                activeId: 0,
                testimonials: [
                    {
                        id: 0,
                        name: 'Elena Rostova',
                        role: 'Head of Operations',
                        company: 'NexaGrowth',
                        avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=160&q=80',
                        initials: 'ER',
                        rating: 5,
                        badge: 'Saved 312 hrs / mo',
                        quote: 'Before TaskVerge, we spent 4 hours every Monday in sync meetings just trying to figure out what was stuck. Now, our dashboard highlights blockers immediately, cutting meetings down to 30 minutes.'
                    },
                    {
                        id: 1,
                        name: 'Marcus Chen',
                        role: 'VP of Engineering',
                        company: 'CloudCore',
                        avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=160&q=80',
                        initials: 'MC',
                        rating: 4.5,
                        badge: '99.4% On-Time Delivery',
                        quote: 'The automatic work balancing and clear blocker reasons are pure gold. Engineers don’t just mark things as stuck—the system shows exactly what is missing so it gets resolved in minutes.'
                    },
                    {
                        id: 2,
                        name: 'Sarah Jenkins',
                        role: 'Managing Director',
                        company: 'StudioCraft',
                        avatar: 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=160&q=80',
                        initials: 'SJ',
                        rating: 4.8,
                        badge: '5-Min Team Onboarding',
                        quote: 'We replaced an enterprise tool that required a two-week onboarding course. Our client coordinators and designers were actively using TaskVerge within 5 minutes of sending the invites.'
                    },
                    {
                        id: 3,
                        name: 'David Kim',
                        role: 'Product Lead',
                        company: 'Veloce Labs',
                        avatar: null,
                        initials: 'DK',
                        rating: 4,
                        badge: 'Zero Forgotten Tasks',
                        quote: 'Having real-time project health without sending daily reminder messages has changed our work culture completely. The team is calmer, more focused, and consistently hits delivery dates.'
                    },
                    {
                        id: 4,
                        name: 'Liam O\'Connor',
                        role: 'Engineering Lead',
                        company: 'NorthStar',
                        avatar: null,
                        initials: 'LO',
                        rating: 4.5,
                        badge: '85% Faster Unblocking',
                        quote: 'The 1-click unblock feature is so simple yet effective. Bottlenecks that used to linger for days get resolved before our lunch break.'
                    }
                ]
            }"
            class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch"
        >
            <!-- Featured Spotlight Card (7 columns) -->
            <div class="lg:col-span-7 rounded-3xl border border-emerald-500/40 bg-gradient-to-br from-emerald-950/30 via-slate-950 to-slate-950 p-6 sm:p-8 flex flex-col justify-between shadow-2xl relative transition-all duration-500">
                <div class="space-y-5">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <!-- Dynamic Star Rating -->
                        <div class="flex items-center gap-1">
                            <template x-for="i in 5">
                                <svg 
                                    class="h-4.5 w-4.5 fill-current transition-colors"
                                    :class="i <= Math.floor(testimonials[activeId].rating) ? 'text-emerald-400' : (i - 0.5 <= testimonials[activeId].rating ? 'text-teal-300' : 'text-slate-700')"
                                    viewBox="0 0 20 20"
                                >
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </template>
                            <span class="text-xs font-mono text-slate-400 ml-2" x-text="testimonials[activeId].rating + ' / 5.0'"></span>
                        </div>
                        <span class="rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-3 py-1 text-xs font-bold font-mono" x-text="testimonials[activeId].badge"></span>
                    </div>

                    <!-- Spotlight Big Quote -->
                    <blockquote class="text-base sm:text-lg text-slate-100 leading-relaxed font-semibold transition-all duration-300" x-text="'&ldquo;' + testimonials[activeId].quote + '&rdquo;'"></blockquote>
                </div>

                <!-- Spotlight Author Strip -->
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-emerald-900/40">
                    <div class="flex items-center gap-3.5">
                        <!-- Photo or Initials Badge -->
                        <template x-if="testimonials[activeId].avatar">
                            <img 
                                :src="testimonials[activeId].avatar" 
                                :alt="testimonials[activeId].name" 
                                class="h-11 w-11 rounded-full object-cover border-2 border-emerald-500 shadow-md"
                            />
                        </template>
                        <template x-if="!testimonials[activeId].avatar">
                            <div class="h-11 w-11 rounded-full bg-gradient-to-tr from-emerald-800 to-teal-600 border-2 border-emerald-400 flex items-center justify-center text-white font-bold text-xs shadow-md" x-text="testimonials[activeId].initials"></div>
                        </template>
                        <div>
                            <div class="text-sm font-bold text-white" x-text="testimonials[activeId].name"></div>
                            <div class="text-xs text-emerald-400" x-text="testimonials[activeId].role + ', ' + testimonials[activeId].company"></div>
                        </div>
                    </div>
                    <span class="text-[11px] text-slate-500 hidden sm:inline">Active Spotlight</span>
                </div>
            </div>

            <!-- Smaller Right Column: Quick Avatar Selector with Tooltips + 2 Small Preview Cards (5 columns) -->
            <div class="lg:col-span-5 flex flex-col justify-between space-y-4">
                <!-- Top Header with Interactive Circle Switcher & Floating Tooltips -->
                <div class="flex items-center justify-between pb-2 border-b border-slate-800/80">
                    <div>
                        <span class="text-xs font-semibold text-slate-300">Customer Stories</span>
                        <p class="text-[10px] text-emerald-400 font-mono">Click circle to spotlight</p>
                    </div>

                    <!-- Small Circle Avatars with Floating Tooltips -->
                    <div class="flex items-center gap-2">
                        <template x-for="(item, idx) in testimonials" :key="item.id">
                            <div class="relative group/circle">
                                <button 
                                    type="button"
                                    @click="activeId = item.id" 
                                    class="h-8 w-8 rounded-full overflow-hidden border-2 transition-all duration-200 flex items-center justify-center cursor-pointer"
                                    :class="activeId === item.id 
                                        ? 'border-emerald-400 ring-2 ring-emerald-500/40 scale-110 shadow-md shadow-emerald-500/30' 
                                        : 'border-slate-700 opacity-60 hover:opacity-100 hover:scale-105 hover:border-slate-500'"
                                    :aria-label="item.name"
                                >
                                    <template x-if="item.avatar">
                                        <img :src="item.avatar" :alt="item.name" class="w-full h-full object-cover"/>
                                    </template>
                                    <template x-if="!item.avatar">
                                        <span class="bg-gradient-to-tr from-emerald-800 to-teal-600 text-white w-full h-full flex items-center justify-center font-bold text-[10px]" x-text="item.initials"></span>
                                    </template>
                                </button>

                                <!-- Floating Tooltip on Hover directly on circle -->
                                <div class="pointer-events-none absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover/circle:opacity-100 transition-all duration-200 z-30 px-2.5 py-1 rounded-lg bg-slate-900 border border-emerald-500/40 text-[11px] font-semibold text-white whitespace-nowrap shadow-2xl">
                                    <!-- <span x-text="item.name + ' • ' + item.company"></span> -->
                                    <span x-text="item.name"></span>
                                    <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-slate-900 border-r border-b border-emerald-500/40 rotate-45"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- 2 Small Preview Cards (Next up in queue) -->
                <div class="grid grid-cols-1 gap-3">
                    <template x-for="item in testimonials.filter(t => t.id !== activeId).slice(0, 2)" :key="item.id">
                        <div 
                            @click="activeId = item.id"
                            class="group relative rounded-2xl border border-slate-800/80 bg-slate-950/70 hover:border-emerald-500/60 hover:bg-slate-900/60 p-4 cursor-pointer transition-all duration-300 shadow-md hover:-translate-y-0.5"
                        >
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2.5">
                                    <template x-if="item.avatar">
                                        <img :src="item.avatar" :alt="item.name" class="h-8 w-8 rounded-full object-cover border border-slate-700"/>
                                    </template>
                                    <template x-if="!item.avatar">
                                        <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-emerald-800 to-teal-600 border border-emerald-400/50 flex items-center justify-center text-white font-bold text-[10px]" x-text="item.initials"></div>
                                    </template>
                                    <div>
                                        <div class="text-xs font-bold text-white group-hover:text-emerald-300 transition-colors" x-text="item.name"></div>
                                        <div class="text-[10px] text-slate-400" x-text="item.role + ', ' + item.company"></div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded-full" x-text="item.badge"></span>
                            </div>

                            <p class="text-xs text-slate-300 line-clamp-2 leading-relaxed italic" x-text="'&ldquo;' + item.quote + '&rdquo;'"></p>

                            <div class="mt-2.5 pt-2 border-t border-slate-800/60 flex items-center justify-between text-[10px] text-slate-400">
                                <span class="text-emerald-400/90 font-mono" x-text="'★ ' + item.rating + ' rating'"></span>
                                <span class="group-hover:text-emerald-400 transition-colors flex items-center gap-1 font-semibold">
                                    Click to Spotlight &rarr;
                                </span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. KEY BENEFITS: Quantifiable Value Horizon (Asymmetric Metrics, Not Identical Boxes) -->
    <section id="benefits" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Key Benefits</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Real Results You Can Measure</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Here is how TaskVerge eliminates confusion and operational friction every single week.</p>
        </div>

        <div class="rounded-3xl border border-slate-800 bg-gradient-to-b from-slate-900/60 to-slate-950 p-8 sm:p-12 lg:p-14">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 divide-y md:divide-y-0 md:divide-x divide-slate-800">
                <!-- Benefit 1 -->
                <div class="space-y-4 md:pr-6 pt-6 md:pt-0">
                    <div class="text-4xl sm:text-5xl font-extrabold text-emerald-400">80% Fewer</div>
                    <h3 class="text-lg font-bold text-white">"What's the status?" Inquiries</h3>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Stop wasting hours every week asking team members where their tasks stand. Anyone can check the live board in 10 seconds.
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="space-y-4 md:px-6 pt-6 md:pt-0">
                    <div class="text-4xl sm:text-5xl font-extrabold text-cyan-400">Zero</div>
                    <h3 class="text-lg font-bold text-white">Forgotten Blockers</h3>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Stuck tasks no longer hide in email threads or chat messages. They stand out on the dashboard until resolved.
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="space-y-4 md:pl-6 pt-6 md:pt-0">
                    <div class="text-4xl sm:text-5xl font-extrabold text-teal-400">100%</div>
                    <h3 class="text-lg font-bold text-white">Team Accountability</h3>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Every task has a single owner, an explicit priority, and a clear deadline. No more guessing who was supposed to do what.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. WHY WE'RE DIFFERENT FROM TRADITIONAL TOOLS -->
    <section id="why-different" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">The Difference</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Why TaskVerge Over Traditional Tools?</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">See how TaskVerge eliminates administrative fatigue compared to fragmented spreadsheets and bloated legacy software.</p>
        </div>

        <!-- Capability Comparison Matrix -->
        <div class="rounded-3xl border border-slate-800 bg-slate-950 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-900/90 text-slate-300 uppercase text-[11px] font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">Capability / Dimension</th>
                            <th class="px-6 py-4 text-slate-400">Spreadsheets & Slack</th>
                            <th class="px-6 py-4 text-slate-400">Bloated Legacy Tools</th>
                            <th class="px-6 py-4 text-emerald-400 bg-emerald-950/30 font-extrabold">TaskVerge Platform</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80 text-slate-300">
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Setup Time & Onboarding</td>
                            <td class="px-6 py-4 text-slate-400">Manual templates, breaks with edits</td>
                            <td class="px-6 py-4 text-slate-400">2–4 weeks onboarding & certification</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">&lt; 2 minutes (Zero-friction)</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Blocker & Bottleneck Detection</td>
                            <td class="px-6 py-4 text-slate-400">Hidden in email/DM threads</td>
                            <td class="px-6 py-4 text-slate-400">Buried in ticket sub-tabs</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Autonomous Attention Radar (Pre-breach)</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Dual-View Flexibility</td>
                            <td class="px-6 py-4 text-slate-400">Static rows and cells only</td>
                            <td class="px-6 py-4 text-slate-400">Cluttered screen switches</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Instant 1-Click Kanban &amp; Table Sync</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Task Intake & Auto-Triage</td>
                            <td class="px-6 py-4 text-slate-400">Manual copy-paste entry</td>
                            <td class="px-6 py-4 text-slate-400">Complex rules engines to write &amp; debug</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Autonomous Intake &amp; Capacity Match</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">1-Click Bottleneck Resolution</td>
                            <td class="px-6 py-4 text-slate-400">Manual follow-up meetings</td>
                            <td class="px-6 py-4 text-slate-400">Multi-step ticket status override</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">1-Click Quick Unblock Action</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Audit Trail & Compliance</td>
                            <td class="px-6 py-4 text-slate-400">None (overwritten cells)</td>
                            <td class="px-6 py-4 text-slate-400">Fragmented comment chains</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Automatic Chronological Activity Log</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">User Administration &amp; Roles</td>
                            <td class="px-6 py-4 text-slate-400">Link sharing without permission tiers</td>
                            <td class="px-6 py-4 text-slate-400">Over-engineered IAM &amp; user groups</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Streamlined Role Gating &amp; Instant Toggles</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Pricing Transparency</td>
                            <td class="px-6 py-4 text-slate-400">Hidden costs in wasted team hours</td>
                            <td class="px-6 py-4 text-slate-400">Mandatory annual enterprise minimums</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Honest flat seat tiers with Annual Savings</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Extra Feature Grid Highlights -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="rounded-2xl border border-slate-800/80 bg-slate-950/70 p-6 space-y-3">
                <div class="h-10 w-10 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-white">Autonomous Stage Transitions</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Pipelines advance cards automatically as requirements and reviews are marked satisfied.</p>
            </div>

            <div class="rounded-2xl border border-slate-800/80 bg-slate-950/70 p-6 space-y-3">
                <div class="h-10 w-10 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-white">Workload Balance Guard</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Monitors individual velocity to prevent burn-out by re-distributing incoming queue surges.</p>
            </div>

            <div class="rounded-2xl border border-slate-800/80 bg-slate-950/70 p-6 space-y-3">
                <div class="h-10 w-10 rounded-xl bg-teal-500/10 border border-teal-500/30 flex items-center justify-center text-teal-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-white">Proactive SLA Radar</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Alerts stakeholders 48 hours before any deadline is in jeopardy, avoiding emergency fixes.</p>
            </div>

            <div class="rounded-2xl border border-slate-800/80 bg-slate-950/70 p-6 space-y-3">
                <div class="h-10 w-10 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-white">Enterprise Security &amp; Audit</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Strict role-based boundaries, Turnstile bot shields, and full chronological task histories.</p>
            </div>
        </div>
    </section>

    <!-- 8. SIMPLE, HONEST PRICING -->
    <section id="pricing" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ billingInterval: 'annual' }">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Pricing Plans</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Simple Plans for Teams of Every Size</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Choose the plan that fits your current operational needs. Upgrade, downgrade, or cancel anytime.</p>

            <!-- Monthly / Annual Billing Toggle with Savings Badge -->
            <div class="mt-8 inline-flex items-center gap-3 p-1.5 rounded-2xl bg-slate-900 border border-slate-800 shadow-inner">
                <button 
                    type="button" 
                    @click="billingInterval = 'monthly'"
                    class="px-5 py-2 rounded-xl text-xs font-bold transition-all duration-200"
                    :class="billingInterval === 'monthly' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-950/50' : 'text-slate-400 hover:text-slate-200'"
                >
                    Monthly Billing
                </button>
                <button 
                    type="button" 
                    @click="billingInterval = 'annual'"
                    class="px-5 py-2 rounded-xl text-xs font-bold transition-all duration-200 flex items-center gap-2"
                    :class="billingInterval === 'annual' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-950/50' : 'text-slate-400 hover:text-slate-200'"
                >
                    <span>Annual Billing</span>
                    <span class="rounded-full bg-emerald-400/20 text-emerald-300 border border-emerald-400/30 text-[10px] px-2 py-0.5 font-extrabold uppercase tracking-wide">
                        Save 20%
                    </span>
                </button>
            </div>
        </div>

        <!-- Elevated Pricing Horizon (Middle card rises with emerald halo) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            <!-- Free Starter -->
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Free Starter</span>
                        <h3 class="text-2xl font-bold text-white mt-1">Free Trial</h3>
                        <p class="text-xs text-slate-400 mt-2">Explore TaskVerge with your immediate team at zero risk.</p>
                    </div>
                    <div class="text-4xl font-extrabold text-white">$0 <span class="text-xs text-slate-400 font-normal">/ 14 days</span></div>
                    <p class="text-[11px] text-emerald-400/80 font-mono">No credit card required to start</p>
                    <ul class="text-xs sm:text-sm text-slate-300 space-y-2.5 pt-4 border-t border-slate-800">
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Up to 3 active workflows</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Up to 3 team member accounts</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Instant Kanban &amp; Table views</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Autonomous triage basics</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Standard community support</li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-3.5 text-xs font-semibold text-white transition-colors">
                    Start 14-Day Free Trial
                </a>
            </div>

            <!-- Operations Core (Raised with Emerald Halo) -->
            <div class="rounded-3xl border-2 border-emerald-500 bg-gradient-to-b from-emerald-950/50 via-slate-950 to-slate-950 p-8 sm:p-9 flex flex-col justify-between space-y-6 relative shadow-2xl lg:-translate-y-4">
                <div class="absolute -top-3.5 right-6 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-1 text-[11px] font-bold uppercase text-white tracking-wider shadow-lg shadow-emerald-500/30">
                    Most Popular
                </div>
                <div class="space-y-4">
                    <div>
                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Growing Teams</span>
                        <h3 class="text-2xl font-bold text-white mt-1">Operations Core</h3>
                        <p class="text-xs text-slate-400 mt-2">Complete workflow orchestration for fast-moving business units.</p>
                    </div>

                    <!-- Dynamic Price calculation based on interval -->
                    <div>
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-4xl font-extrabold text-white" x-text="billingInterval === 'annual' ? '$39' : '$49'">$39</span>
                            <span class="text-xs text-slate-400 font-normal">/ seat / month</span>
                        </div>
                        <div class="text-[11px] text-emerald-400 mt-1 font-mono" x-show="billingInterval === 'annual'">
                            Billed annually ($468/yr per seat) • Save $120/yr
                        </div>
                        <div class="text-[11px] text-slate-500 mt-1 font-mono" x-show="billingInterval === 'monthly'">
                            Billed month-to-month, pause or cancel anytime
                        </div>
                    </div>

                    <ul class="text-xs sm:text-sm text-slate-200 space-y-2.5 pt-4 border-t border-emerald-900/60">
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> <strong>Unlimited</strong> workflows &amp; tasks</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Up to 25 team members</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Real-time Intelligence Dashboard</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Predictive Bottleneck Radar (48h advance warning)</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> 1-Click Bottleneck Resolution</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Full chronological activity audit logs</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Expedited support SLA (under 4 hours)</li>
                    </ul>
                </div>
                <a 
                    :href="'{{ route('checkout') }}?plan=core&interval=' + billingInterval" 
                    class="block text-center rounded-xl bg-emerald-600 hover:bg-emerald-500 py-3.5 text-xs font-bold text-white transition-all shadow-xl shadow-emerald-600/30"
                >
                    <span x-text="billingInterval === 'annual' ? 'Choose Operations Core (Annual Save 20%)' : 'Choose Operations Core (Monthly)'">Choose Operations Core</span>
                </a>
            </div>

            <!-- Enterprise Scale -->
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Scale &amp; Multi-Team</span>
                        <h3 class="text-2xl font-bold text-white mt-1">Enterprise Plan</h3>
                        <p class="text-xs text-slate-400 mt-2">For cross-functional organizations requiring tailored governance.</p>
                    </div>

                    <!-- Dynamic Price calculation based on interval -->
                    <div>
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-4xl font-extrabold text-white" x-text="billingInterval === 'annual' ? '$95' : '$119'">$95</span>
                            <span class="text-xs text-slate-400 font-normal">/ seat / month</span>
                        </div>
                        <div class="text-[11px] text-emerald-400 mt-1 font-mono" x-show="billingInterval === 'annual'">
                            Billed annually ($1,140/yr per seat) • Save $288/yr
                        </div>
                        <div class="text-[11px] text-slate-500 mt-1 font-mono" x-show="billingInterval === 'monthly'">
                            Billed month-to-month, pause or cancel anytime
                        </div>
                    </div>

                    <ul class="text-xs sm:text-sm text-slate-300 space-y-2.5 pt-4 border-t border-slate-800">
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> All Operations Core features</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> <strong>Unlimited</strong> team members &amp; departments</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Self-healing pipeline orchestration</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Advanced Admin Panel with custom roles</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Dedicated onboarding architect</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> 99.9% uptime SLA &amp; 24/7 priority support</li>
                    </ul>
                </div>
                <a 
                    :href="'{{ route('checkout') }}?plan=intelligence&interval=' + billingInterval" 
                    class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-3.5 text-xs font-semibold text-white transition-colors"
                >
                    <span x-text="billingInterval === 'annual' ? 'Choose Enterprise (Annual Save 20%)' : 'Choose Enterprise (Monthly)'">Choose Enterprise</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 9. FREQUENTLY ASKED QUESTIONS (FAQ) -->
    <section id="faq" class="px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">FAQ</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Common Questions Answered</h2>
        </div>

        <div class="space-y-4">
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 space-y-2 shadow-sm">
                <h3 class="text-sm sm:text-base font-bold text-white">How does the autonomous task routing work?</h3>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                    TaskVerge evaluates incoming tasks against team capacity, department skills, and active commitments, automatically tagging priority and routing each task to the best-suited stage and owner.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 space-y-2 shadow-sm">
                <h3 class="text-sm sm:text-base font-bold text-white">Can I switch between Kanban boards and List tables?</h3>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                    Yes! Every workflow comes with an instant dual-view toggle. You can view your project as a visual card board or as an organized data table whenever you like.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 space-y-2 shadow-sm">
                <h3 class="text-sm sm:text-base font-bold text-white">What is the Predictive Bottleneck Radar?</h3>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                    The radar tracks how long cards linger in review or pending stages. If progress slows down relative to historical sprint norms, it raises early warning flags 48 hours in advance so managers can unblock before due dates are breached.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 space-y-2 shadow-sm">
                <h3 class="text-sm sm:text-base font-bold text-white">Can I try TaskVerge before buying?</h3>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                    Absolutely. You can start a free trial with no credit card required, or test our live demo personas directly on the login page.
                </p>
            </div>
        </div>
    </section>

    <!-- 10. CONTACT US: 2 Branch Locations with Google Maps & Live Support Form -->
    <section id="contact" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ activeBranch: 'sf' }">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Get in Touch</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Contact Our Global Teams</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Have a question about deployment, enterprise SLA, or custom pipelines? We are here to help.</p>
        </div>

        @if(session('contact_status'))
            <div class="mb-10 max-w-4xl mx-auto rounded-2xl bg-emerald-500/10 border border-emerald-500/30 p-5 text-sm font-medium text-emerald-300 flex items-center gap-3 shadow-lg shadow-emerald-950/40">
                <svg class="h-5 w-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('contact_status') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Left Column: 2 Branches with Interactive Google Maps & Contact Numbers (7 Cols) -->
            <div class="lg:col-span-7 flex flex-col justify-between space-y-6">
                <!-- Branch Selector Pills -->
                <div class="flex items-center justify-between flex-wrap gap-3 pb-2 border-b border-slate-800">
                    <div class="text-xs font-bold text-slate-300 uppercase tracking-wider">Operational Branches</div>
                    <div class="inline-flex rounded-xl bg-slate-900 border border-slate-800 p-1">
                        <button 
                            type="button" 
                            @click="activeBranch = 'sf'" 
                            class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all"
                            :class="activeBranch === 'sf' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white'"
                        >
                            San Francisco HQ
                        </button>
                        <button 
                            type="button" 
                            @click="activeBranch = 'london'" 
                            class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all"
                            :class="activeBranch === 'london' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white'"
                        >
                            London EMEA Hub
                        </button>
                    </div>
                </div>

                <!-- Branch 1: San Francisco -->
                <div x-show="activeBranch === 'sf'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
                    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xl">
                        <div>
                            <div class="inline-flex items-center gap-2 text-xs font-bold text-emerald-400 uppercase tracking-wider">
                                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                Global Headquarters
                            </div>
                            <h3 class="text-xl font-bold text-white mt-1">TaskVerge Americas • San Francisco</h3>
                            <p class="text-xs text-slate-400 mt-1">500 Howard Street, Suite 400, San Francisco, CA 94105, United States</p>
                        </div>
                        <div class="space-y-1 sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-800/80">
                            <div class="text-xs text-slate-400 font-mono">Direct Support Phone</div>
                            <a href="tel:+14158022040" class="text-sm font-bold text-emerald-300 hover:text-emerald-200 transition-colors font-mono">+1 (415) 802-2040</a>
                            <div class="text-[11px] text-slate-500 font-mono">Mon–Fri 8:00 AM – 6:00 PM PST</div>
                        </div>
                    </div>

                    <!-- San Francisco Embedded Google Map -->
                    <div class="rounded-3xl border border-slate-800 overflow-hidden shadow-2xl h-[300px] relative bg-slate-900">
                        <iframe 
                            title="TaskVerge San Francisco Headquarters Map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.084883391295!2d-122.39893462348566!3d37.78801997198207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085807cb67d5e4b%3A0x6e5c8e390c2ebaa8!2s500%20Howard%20St%2C%20San%20Francisco%2C%20CA%2094105!5e0!3m2!1sen!2sus!4v1710000000000!5m2!1sen!2sus" 
                            width="100%" 
                            height="100%" 
                            style="border:0; filter: invert(90%) hue-rotate(180deg) contrast(1.1);" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full"
                        ></iframe>
                    </div>
                </div>

                <!-- Branch 2: London -->
                <div x-show="activeBranch === 'london'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
                    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xl">
                        <div>
                            <div class="inline-flex items-center gap-2 text-xs font-bold text-teal-400 uppercase tracking-wider">
                                <span class="h-2 w-2 rounded-full bg-teal-400 animate-pulse"></span>
                                EMEA Operations Hub
                            </div>
                            <h3 class="text-xl font-bold text-white mt-1">TaskVerge Europe • London</h3>
                            <p class="text-xs text-slate-400 mt-1">25 Bank Street, Canary Wharf, London E14 5JP, United Kingdom</p>
                        </div>
                        <div class="space-y-1 sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-800/80">
                            <div class="text-xs text-slate-400 font-mono">EMEA Support Phone</div>
                            <a href="tel:+442079460830" class="text-sm font-bold text-teal-300 hover:text-teal-200 transition-colors font-mono">+44 (20) 7946 0830</a>
                            <div class="text-[11px] text-slate-500 font-mono">Mon–Fri 9:00 AM – 6:00 PM GMT</div>
                        </div>
                    </div>

                    <!-- London Embedded Google Map -->
                    <div class="rounded-3xl border border-slate-800 overflow-hidden shadow-2xl h-[300px] relative bg-slate-900">
                        <iframe 
                            title="TaskVerge London EMEA Hub Map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.541460309855!2d-0.021578623438965934!3d51.503299711019625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487602b9e693b7a5%3A0x6d88c0378b8719bc!2s25%20Bank%20St%2C%20London%20E14%205JP%2C%20UK!5e0!3m2!1sen!2suk!4v1710000000000!5m2!1sen!2suk" 
                            width="100%" 
                            height="100%" 
                            style="border:0; filter: invert(90%) hue-rotate(180deg) contrast(1.1);" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full"
                        ></iframe>
                    </div>
                </div>

                <!-- Unified Shared Email Badge for Both Branches -->
                <div class="rounded-2xl border border-emerald-500/30 bg-gradient-to-r from-emerald-950/40 via-slate-950 to-teal-950/40 p-4 flex items-center justify-between flex-wrap gap-3">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shrink-0">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 uppercase font-bold tracking-wider">Universal Support Inbox</span>
                            <div class="text-sm font-bold text-white">help@taskverge.net</div>
                        </div>
                    </div>
                    <a href="mailto:help@taskverge.net" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-400 hover:text-emerald-300 font-mono transition-colors">
                        Send Direct Email &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Column: Interactive Contact Form (5 Cols) -->
            <div class="lg:col-span-5 rounded-3xl border border-slate-800 bg-gradient-to-b from-slate-900/90 to-slate-950 p-6 sm:p-8 flex flex-col justify-between shadow-2xl space-y-6">
                <div>
                    <h3 class="text-xl font-bold text-white">Send Us a Message</h3>
                    <p class="text-xs text-slate-400 mt-1">All submissions route directly to <strong class="text-emerald-400 font-mono">our team</strong> with full ticket telemetry.</p>
                </div>

                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="contact_name" class="block text-xs font-semibold text-slate-300 mb-1">Your Full Name <span class="text-emerald-400">*</span></label>
                        <input 
                            type="text" 
                            id="contact_name" 
                            name="name" 
                            value="{{ old('name', Auth::user()?->name) }}"
                            required 
                            placeholder="e.g. Alex Morgan"
                            class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors"
                        />
                        @error('name')
                            <p class="text-[11px] text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="contact_email" class="block text-xs font-semibold text-slate-300 mb-1">Email Address <span class="text-emerald-400">*</span></label>
                            <input 
                                type="email" 
                                id="contact_email" 
                                name="email" 
                                value="{{ old('email', Auth::user()?->email) }}"
                                required 
                                placeholder="name@company.com"
                                class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors"
                            />
                            @error('email')
                                <p class="text-[11px] text-rose-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_phone" class="block text-xs font-semibold text-slate-300 mb-1">Phone (Optional)</label>
                            <input 
                                type="tel" 
                                id="contact_phone" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                placeholder="+1 (555) 000-0000"
                                class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="contact_branch" class="block text-xs font-semibold text-slate-300 mb-1">Select Branch</label>
                            <select 
                                id="contact_branch" 
                                name="branch"
                                class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2.5 text-xs text-white focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors"
                            >
                                <option value="San Francisco HQ (Americas)">San Francisco HQ (Americas)</option>
                                <option value="London EMEA Hub (Europe)">London EMEA Hub (Europe)</option>
                                <option value="General Global Support">General Global Support</option>
                            </select>
                        </div>

                        <div>
                            <label for="contact_subject" class="block text-xs font-semibold text-slate-300 mb-1">Subject</label>
                            <input 
                                type="text" 
                                id="contact_subject" 
                                name="subject" 
                                value="{{ old('subject') }}"
                                placeholder="Enterprise / Support"
                                class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="contact_message" class="block text-xs font-semibold text-slate-300 mb-1">Message <span class="text-emerald-400">*</span></label>
                        <textarea 
                            id="contact_message" 
                            name="message" 
                            rows="4" 
                            required 
                            placeholder="Tell us about your team size, workflow requirements, or question..."
                            class="w-full rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors resize-none"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-[11px] text-rose-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button 
                        type="submit" 
                        class="w-full rounded-xl bg-emerald-600 hover:bg-emerald-500 py-3 text-xs font-bold text-white transition-all shadow-xl shadow-emerald-600/30 flex items-center justify-center gap-2"
                    >
                        <span>Send Message to help@taskverge.net</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- 11. FINAL CALL TO ACTION LAUNCHPAD -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="rounded-3xl border border-emerald-500/30 bg-gradient-to-r from-emerald-950/60 via-slate-950 to-teal-950/40 p-10 sm:p-14 text-center space-y-6 shadow-2xl relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-60 h-60 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Ready for autonomous workflow intelligence?</h2>
            <p class="text-sm sm:text-base text-slate-300 max-w-xl mx-auto leading-relaxed">
                Join teams who organize their daily work with visual clarity, fast autonomous triage, and zero clutter.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3.5 pt-2">
                <a href="{{ route('register') }}" class="rounded-xl bg-emerald-600 px-7 py-3.5 text-sm font-bold text-white hover:bg-emerald-500 transition-all shadow-xl shadow-emerald-600/30 scale-100 hover:scale-105">
                    Get Started Free
                </a>
                <a href="{{ route('login') }}" class="rounded-xl border border-slate-700 bg-slate-900 px-6 py-3.5 text-sm font-semibold text-slate-200 hover:bg-slate-800 hover:text-white transition-colors">
                    Explore Live Workspace
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

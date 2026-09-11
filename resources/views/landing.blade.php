@extends('layouts.guest')

@section('content')
<div class="space-y-36 sm:space-y-48 lg:space-y-56 pb-36 overflow-hidden">
    <!-- 1. HERO SECTION: Full Viewport Height Screen with Autonomous Neural Telemetry Showcase -->
    <section class="relative min-h-[calc(100vh-4rem)] flex flex-col justify-center px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto py-12 lg:py-16">
        <!-- Ambient Neural Glow Spheres -->
        <div class="absolute -top-24 left-1/4 -translate-x-1/2 w-[650px] h-[450px] bg-emerald-500/15 rounded-full blur-[150px] pointer-events-none"></div>
        <div class="absolute top-1/3 right-10 w-[550px] h-[400px] bg-teal-500/15 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center relative z-10 my-auto">
            <!-- Left: Hero Headline & Narrative -->
            <div class="lg:col-span-7 space-y-7 text-left">
                <!-- Innovative Neural Telemetry Beacon Pill (Not Generic) -->
                <div class="inline-flex items-center gap-3 rounded-full border border-emerald-500/30 bg-gradient-to-r from-emerald-950/80 via-slate-900/90 to-teal-950/80 px-4 py-2 backdrop-blur-xl shadow-lg shadow-emerald-500/10 group hover:border-emerald-400/60 transition-all">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <!-- Equalizer frequency bars -->
                    <div class="flex items-center gap-1 h-3">
                        <span class="w-0.5 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span class="w-0.5 h-3 bg-emerald-300 rounded-full animate-pulse" style="animation-delay: 120ms"></span>
                        <span class="w-0.5 h-1.5 bg-teal-400 rounded-full animate-pulse" style="animation-delay: 240ms"></span>
                        <span class="w-0.5 h-3 bg-emerald-400 rounded-full animate-pulse" style="animation-delay: 360ms"></span>
                    </div>
                    <span class="text-[11px] font-bold tracking-wider uppercase text-emerald-300">Neural Engine Online</span>
                    <span class="text-slate-600 font-mono text-xs">•</span>
                    <span class="text-[11px] font-medium text-slate-300">4,892 Workflows Self-Healed Today</span>
                    <svg class="h-3 w-3 text-emerald-400 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.12]">
                    Workflows that triage, assign, and <br>
                    <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">unblock themselves.</span>
                </h1>

                <!-- Clear Value Proposition -->
                <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed">
                    Stop running endless status meetings and chasing stalled tickets. <strong>TaskVerge</strong> analyzes team workloads in real-time, predicts deadline risks 48 hours early, and automatically unblocks dependencies so your people stay in flow.
                </p>

                <!-- High-Impact Action CTAs -->
                <div class="flex flex-wrap items-center gap-3.5 pt-2">
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

                <!-- Quantifiable Hero Proof Metrics Strip -->
                <div class="pt-4 grid grid-cols-3 gap-6 border-t border-slate-800/80 max-w-lg">
                    <div>
                        <div class="text-2xl font-extrabold text-emerald-400">-84%</div>
                        <div class="text-xs text-slate-400 mt-0.5">Status Meeting Drag</div>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-teal-400">99.4%</div>
                        <div class="text-xs text-slate-400 mt-0.5">Autonomous Triage Accuracy</div>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-cyan-400">&lt; 2 min</div>
                        <div class="text-xs text-slate-400 mt-0.5">Instant Team Setup</div>
                    </div>
                </div>
            </div>

            <!-- Right: The Autonomous Orchestration Console (Layered Futuristic Flow UI) -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Outer Decorative Glow -->
                    <div class="absolute -inset-1.5 bg-gradient-to-tr from-emerald-500/25 via-teal-500/20 to-cyan-500/20 rounded-3xl blur-2xl opacity-80"></div>

                    <!-- Main Autonomous Console Container -->
                    <div class="relative rounded-3xl border border-slate-800 bg-slate-950/95 p-5 backdrop-blur-2xl shadow-2xl space-y-4">
                        <!-- Top HUD Bar -->
                        <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-bold text-white uppercase tracking-wider">Autonomous Execution Hub</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-mono text-emerald-400 bg-emerald-950/80 border border-emerald-500/30 px-2 py-0.5 rounded-md">
                                    Latency: 4ms
                                </span>
                            </div>
                        </div>

                        <!-- Simulated Flow Stream: Stage 1 Auto-Triaged -->
                        <div class="rounded-xl border border-emerald-500/30 bg-slate-900/90 p-4 transition-all hover:border-emerald-500/60 shadow-sm relative overflow-hidden group">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500"></div>
                            <div class="flex items-start justify-between gap-3 pl-1">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 rounded-md bg-emerald-500/20 px-2 py-0.5 text-[10px] font-bold text-emerald-300 uppercase tracking-wide border border-emerald-500/30">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            Auto-Triaged
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">TSK-2041</span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white mt-1.5 group-hover:text-emerald-300 transition-colors">
                                        Distributed Rate Limiter Upgrade
                                    </h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        Assigned to Devon Reed • Capacity matched at 78% sprint velocity.
                                    </p>
                                </div>
                                <span class="text-[10px] text-emerald-400/80 font-mono whitespace-nowrap">99.4% Match</span>
                            </div>
                        </div>

                        <!-- Simulated Flow Stream: Stage 2 Bottleneck Predicted -->
                        <div class="rounded-xl border border-amber-500/40 bg-slate-900/90 p-4 transition-all hover:border-amber-500/60 shadow-sm relative overflow-hidden group">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-500"></div>
                            <div class="flex items-start justify-between gap-3 pl-1">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-500/20 px-2 py-0.5 text-[10px] font-bold text-amber-300 uppercase tracking-wide border border-amber-500/30">
                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                            Bottleneck Predicted
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">TSK-1890</span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white mt-1.5 group-hover:text-amber-300 transition-colors">
                                        Third-Party Security Audit Sign-off
                                    </h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        SLA delay risk +4h predicted • Auto-suggested secondary reviewer.
                                    </p>
                                </div>
                                <span class="text-[10px] text-amber-400/90 font-mono whitespace-nowrap">SLA Risk</span>
                            </div>
                        </div>

                        <!-- Simulated Flow Stream: Stage 3 Self-Healed -->
                        <div class="rounded-xl border border-teal-500/30 bg-slate-900/90 p-4 transition-all hover:border-teal-500/60 shadow-sm relative overflow-hidden group">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-teal-500"></div>
                            <div class="flex items-start justify-between gap-3 pl-1">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 rounded-md bg-teal-500/20 px-2 py-0.5 text-[10px] font-bold text-teal-300 uppercase tracking-wide border border-teal-500/30">
                                            <span class="h-1.5 w-1.5 rounded-full bg-teal-400"></span>
                                            Self-Healed
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">TSK-1744</span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white mt-1.5 group-hover:text-teal-300 transition-colors">
                                        Cloud Cluster Failover Re-route
                                    </h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        Unblocked upstream pipeline • Auto-transitioned to QA review.
                                    </p>
                                </div>
                                <span class="text-[10px] text-teal-400 font-mono whitespace-nowrap">&check; Auto-Resolved</span>
                            </div>
                        </div>

                        <!-- Bottom Console Live Telemetry Footer -->
                        <div class="pt-2 flex items-center justify-between text-[11px] text-slate-400">
                            <span class="flex items-center gap-1.5">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                Zero human intervention needed
                            </span>
                            <a href="#how-it-works" class="text-emerald-400 hover:text-emerald-300 font-semibold transition-colors">
                                Explore Pipeline &rarr;
                            </a>
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
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">About Us & Our Mission</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                            We believe task management should work for you, not the other way around.
                        </h2>
                    </div>

                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        Traditional project boards have devolved into static digital graveyards. They demand tedious manual status inquiries, daily spreadsheet reconciliation, and constant supervisor babysitting just to answer basic questions.
                    </p>

                    <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
                        We engineered <strong>TaskVerge</strong> as an autonomous workflow intelligence layer. It operates silently beside your team—continuously observing workload distributions, identifying stalled dependencies before they manifest as missed deadlines, and autonomously triaging deliverables to clear roadblocks.
                    </p>

                    <!-- Contrast Strip: The Old Way vs The TaskVerge Way -->
                    <div class="pt-4 border-t border-slate-800 space-y-3">
                        <div class="flex items-start gap-3 text-xs">
                            <span class="rounded bg-rose-500/10 text-rose-400 border border-rose-500/20 px-2 py-0.5 font-bold uppercase shrink-0">The Old Way</span>
                            <span class="text-slate-400">Hours lost each week to "What's the status?" syncs, forgotten tickets, and spreadsheet chaos.</span>
                        </div>
                        <div class="flex items-start gap-3 text-xs">
                            <span class="rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-0.5 font-bold uppercase shrink-0">The TaskVerge Way</span>
                            <span class="text-slate-200 font-medium">Continuous autonomous triaging, real-time SLA radar, and instant 1-click unblock actions.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. WHAT IT DOES: Asymmetric Bento Architecture (Grand Master Console + Staggered Deep-Dives) -->
    <section id="what-it-does" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">What It Does</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Autonomous Capabilities That Drive Velocity</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Replace manual micromanagement with an intelligent workflow fabric that keeps work flowing 24/7.</p>
        </div>

        <!-- Asymmetric Bento Showcase (Not 4 identical square boxes!) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Master Console 1: Autonomous Triage (Wide, 7 columns) -->
            <div class="lg:col-span-7 rounded-3xl border border-slate-800 bg-slate-950 p-7 sm:p-8 flex flex-col justify-between hover:border-emerald-500/40 transition-all shadow-xl">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="rounded-lg bg-emerald-500/10 border border-emerald-500/30 px-2.5 py-1 text-xs font-bold text-emerald-300 uppercase tracking-wide">
                            Core Engine
                        </span>
                        <span class="text-xs font-mono text-slate-400">99.4% Routing Precision</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Autonomous Task Routing & Capacity Matching</h3>
                    <p class="text-sm text-slate-300 leading-relaxed mt-2.5">
                        New tasks are automatically evaluated against real-time engineer capacity, department skill matrices, and deadline criticality. The engine routes work directly to the right specialist stage without managerial handoffs.
                    </p>
                </div>

                <!-- Interactive Mini Mockup -->
                <div class="mt-6 rounded-2xl border border-slate-800 bg-slate-900/80 p-4 space-y-2">
                    <div class="flex items-center justify-between text-xs text-slate-400 border-b border-slate-800 pb-2">
                        <span class="font-mono text-emerald-400">Incoming: Triton Kernel Benchmark</span>
                        <span class="text-[11px] text-emerald-300 bg-emerald-950/60 px-2 py-0.5 rounded">Auto-Triaged to DevOps</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 text-[11px] text-slate-300 pt-1">
                        <div class="bg-slate-950/60 p-2 rounded border border-slate-800/80">Priority: <strong class="text-rose-400">Critical</strong></div>
                        <div class="bg-slate-950/60 p-2 rounded border border-slate-800/80">Owner: <strong class="text-slate-200">Sarah Jenkins</strong></div>
                        <div class="bg-slate-950/60 p-2 rounded border border-slate-800/80">Est: <strong class="text-slate-200">16 hrs</strong></div>
                    </div>
                </div>
            </div>

            <!-- Master Console 2: Predictive Bottleneck Radar (5 columns with visual radar) -->
            <div class="lg:col-span-5 rounded-3xl border border-slate-800 bg-gradient-to-b from-amber-950/20 via-slate-950 to-slate-950 p-7 sm:p-8 flex flex-col justify-between hover:border-amber-500/40 transition-all shadow-xl">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="rounded-lg bg-amber-500/10 border border-amber-500/30 px-2.5 py-1 text-xs font-bold text-amber-300 uppercase tracking-wide">
                            Early Warning Radar
                        </span>
                        <span class="text-xs font-mono text-amber-400">48h Advance Sentry</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Predictive Bottleneck Radar</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mt-2">
                        Monitors cycle times and cross-department dependencies. If a review stage slows down, TaskVerge flags the delay risk before deadlines are compromised.
                    </p>
                </div>

                <!-- Sonar Radar SVG Visualization -->
                <div class="mt-6 rounded-2xl border border-amber-500/20 bg-slate-900/60 p-4 text-center relative overflow-hidden">
                    <div class="relative w-28 h-28 mx-auto flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full border border-amber-500/20"></div>
                        <div class="absolute inset-3 rounded-full border border-amber-500/30"></div>
                        <div class="absolute inset-7 rounded-full border border-amber-500/40"></div>
                        <div class="h-2 w-2 rounded-full bg-amber-400 shadow-md shadow-amber-400/50 animate-ping"></div>
                    </div>
                    <div class="text-[11px] text-amber-300 font-semibold mt-2">1 Impending Blocker Detected &bull; Stage: QA Review</div>
                </div>
            </div>

            <!-- Master Console 3: Self-Healing Pipeline Engine (5 columns) -->
            <div class="lg:col-span-5 rounded-3xl border border-slate-800 bg-gradient-to-b from-teal-950/20 via-slate-950 to-slate-950 p-7 sm:p-8 flex flex-col justify-between hover:border-teal-500/40 transition-all shadow-xl">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="rounded-lg bg-teal-500/10 border border-teal-500/30 px-2.5 py-1 text-xs font-bold text-teal-300 uppercase tracking-wide">
                            Self-Healing Engine
                        </span>
                        <span class="text-xs font-mono text-teal-400">Auto-Escalation</span>
                    </div>
                    <h3 class="text-xl font-bold text-white">Self-Healing Pipeline Stages</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mt-2">
                        When a task is halted, TaskVerge isolates the dependency, routes alternate review paths, and arms managers with immediate 1-click unblock actions.
                    </p>
                </div>

                <div class="mt-6 rounded-2xl border border-teal-500/20 bg-slate-900/60 p-3.5 space-y-2 text-xs">
                    <div class="flex items-center justify-between text-teal-300">
                        <span>Blocker Reason Mandated</span>
                        <span class="text-emerald-400">&check; Logged</span>
                    </div>
                    <div class="flex items-center justify-between text-teal-300">
                        <span>Alternative Reviewer Triggered</span>
                        <span class="text-emerald-400">&check; Dispatched</span>
                    </div>
                </div>
            </div>

            <!-- Master Console 4: Zero-Effort Executive Debriefs (Wide, 7 columns) -->
            <div class="lg:col-span-7 rounded-3xl border border-slate-800 bg-slate-950 p-7 sm:p-8 flex flex-col justify-between hover:border-emerald-500/40 transition-all shadow-xl">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="rounded-lg bg-emerald-500/10 border border-emerald-500/30 px-2.5 py-1 text-xs font-bold text-emerald-300 uppercase tracking-wide">
                            Audit & Reporting
                        </span>
                        <span class="text-xs font-mono text-slate-400">Zero Standup Fatigue</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Automated Audit & Executive Debriefs</h3>
                    <p class="text-sm text-slate-300 leading-relaxed mt-2.5">
                        Every stage change, blocker notation, and handover is compiled into an immutable chronological audit trail. Stakeholders get instant visibility without interrupting creators with manual status requests.
                    </p>
                </div>

                <div class="mt-6 rounded-2xl border border-slate-800 bg-slate-900/80 p-4 flex items-center justify-between text-xs">
                    <span class="text-slate-300">Complete historical logging on all pipelines</span>
                    <a href="{{ route('register') }}" class="text-emerald-400 hover:text-emerald-300 font-semibold transition-colors">See Live Workspace &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. HOW IT WORKS: Continuous Circuit Conduit (Timeline Node Flow, Not Square Boxes) -->
    <section id="how-it-works" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Step-by-Step</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">How It Works: Autonomous Execution in 4 Steps</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">From raw request intake to automated delivery without manual bottlenecks.</p>
        </div>

        <!-- Connected Node Flow Stream -->
        <div class="relative">
            <!-- Connecting glowing circuit line behind nodes on desktop -->
            <div class="hidden lg:block absolute top-1/2 left-10 right-10 h-0.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 -translate-y-1/2 z-0 opacity-40"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
                <!-- Node 1 -->
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col justify-between hover:border-emerald-500/50 transition-all shadow-xl group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="h-10 w-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-extrabold text-sm flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                                01
                            </span>
                            <span class="text-[10px] font-mono uppercase tracking-wider text-emerald-400 bg-emerald-950/60 px-2 py-0.5 rounded">Intake</span>
                        </div>
                        <h3 class="text-base font-bold text-white">Connect Workflows</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-2">
                            Set up your stages in 2 minutes or use pre-configured pipelines for operations, software, and design workflows.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-900 text-[11px] text-slate-500 font-mono">Zero-friction setup</div>
                </div>

                <!-- Node 2 -->
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col justify-between hover:border-emerald-500/50 transition-all shadow-xl group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="h-10 w-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-extrabold text-sm flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                                02
                            </span>
                            <span class="text-[10px] font-mono uppercase tracking-wider text-emerald-400 bg-emerald-950/60 px-2 py-0.5 rounded">Triage</span>
                        </div>
                        <h3 class="text-base font-bold text-white">Autonomous Triage</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-2">
                            The AI engine parses requirements, scores priority, and assigns the optimal owner based on team bandwidth.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-900 text-[11px] text-slate-500 font-mono">Capacity-aware matching</div>
                </div>

                <!-- Node 3 -->
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col justify-between hover:border-emerald-500/50 transition-all shadow-xl group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="h-10 w-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-extrabold text-sm flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                                03
                            </span>
                            <span class="text-[10px] font-mono uppercase tracking-wider text-amber-400 bg-amber-950/60 px-2 py-0.5 rounded">Sentry</span>
                        </div>
                        <h3 class="text-base font-bold text-white">Continuous AI Radar</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-2">
                            Monitors stage velocity around the clock, raising proactive warnings 48 hours before deadlines are compromised.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-900 text-[11px] text-slate-500 font-mono">Predictive risk alerts</div>
                </div>

                <!-- Node 4 -->
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col justify-between hover:border-emerald-500/50 transition-all shadow-xl group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="h-10 w-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-extrabold text-sm flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                                04
                            </span>
                            <span class="text-[10px] font-mono uppercase tracking-wider text-teal-400 bg-teal-950/60 px-2 py-0.5 rounded">Delivery</span>
                        </div>
                        <h3 class="text-base font-bold text-white">Self-Heal & Complete</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-2">
                            Blockers are resolved via alternate paths or 1-click unblock actions, keeping deliverables on target.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-900 text-[11px] text-slate-500 font-mono">Guaranteed completion</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. CREATIVE TESTIMONIALS: Executive Spotlight Stage -->
    <section id="testimonials" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Customer Stories</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Loved by Teams Who Value Clarity</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">See how leaders in operations, engineering, and studios eliminated project clutter.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <!-- Featured Grand Testimonial (7 columns) -->
            <div class="lg:col-span-7 rounded-3xl border border-emerald-500/40 bg-gradient-to-br from-emerald-950/30 via-slate-950 to-slate-950 p-8 sm:p-10 flex flex-col justify-between shadow-2xl relative">
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 text-emerald-400">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-3 py-1 text-xs font-bold font-mono">
                            Saved 312 hrs / month
                        </span>
                    </div>

                    <blockquote class="text-lg sm:text-xl text-slate-100 leading-relaxed font-semibold">
                        "Before TaskVerge, we spent 4 hours every Monday in sync meetings just trying to figure out what was stuck. Now, our dashboard highlights blockers immediately, cutting meetings down to 30 minutes."
                    </blockquote>
                </div>

                <div class="flex items-center gap-4 pt-6 mt-6 border-t border-emerald-900/50">
                    <img 
                        src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=160&q=80" 
                        alt="Elena Rostova" 
                        class="h-12 w-12 rounded-full object-cover border-2 border-emerald-500 shadow-md"
                        loading="lazy"
                    />
                    <div>
                        <div class="text-sm font-bold text-white">Elena Rostova</div>
                        <div class="text-xs text-emerald-400">Head of Operations, NexaGrowth</div>
                    </div>
                </div>
            </div>

            <!-- Staggered Right Testimonials (5 columns) -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <!-- Testimonial 2 -->
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col justify-between space-y-4 hover:border-slate-700 transition-all shadow-lg flex-1">
                    <blockquote class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        "The autonomous triage and mandatory blocker reason features are pure genius. Developers don't just mark things 'blocked'—the engine highlights what is needed and routes it."
                    </blockquote>
                    <div class="flex items-center gap-3 pt-3 border-t border-slate-900">
                        <img 
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80" 
                            alt="Marcus Chen" 
                            class="h-9 w-9 rounded-full object-cover border border-slate-700"
                            loading="lazy"
                        />
                        <div>
                            <div class="text-xs font-bold text-white">Marcus Chen</div>
                            <div class="text-[11px] text-slate-400">VP of Engineering, CloudCore</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 flex flex-col justify-between space-y-4 hover:border-slate-700 transition-all shadow-lg flex-1">
                    <blockquote class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        "We replaced an enterprise tool that required a two-week onboarding course. Our client coordinators and designers were using TaskVerge within 5 minutes of sending the invites."
                    </blockquote>
                    <div class="flex items-center gap-3 pt-3 border-t border-slate-900">
                        <img 
                            src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=120&q=80" 
                            alt="Sarah Jenkins" 
                            class="h-9 w-9 rounded-full object-cover border border-slate-700"
                            loading="lazy"
                        />
                        <div>
                            <div class="text-xs font-bold text-white">Sarah Jenkins</div>
                            <div class="text-[11px] text-slate-400">Managing Director, StudioCraft</div>
                        </div>
                    </div>
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
                    <div class="text-4xl sm:text-5xl font-extrabold text-amber-400">Zero</div>
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
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Why TaskVerge Over Traditional Project Tools?</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">See how TaskVerge compares to bloated legacy software and disorganized spreadsheets.</p>
        </div>

        <div class="rounded-3xl border border-slate-800 bg-slate-950 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead class="bg-slate-900/90 text-slate-300 uppercase text-[11px] font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-6 py-4">Capability</th>
                            <th class="px-6 py-4 text-slate-400">Spreadsheets & Email</th>
                            <th class="px-6 py-4 text-slate-400">Traditional Bloated Tools</th>
                            <th class="px-6 py-4 text-emerald-400 bg-emerald-950/30 font-extrabold">TaskVerge</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80 text-slate-300">
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Setup Time</td>
                            <td class="px-6 py-4 text-slate-400">Manual templates, breaks easily</td>
                            <td class="px-6 py-4 text-slate-400">Days or weeks of configuration</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Under 2 minutes</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Blocker Detection</td>
                            <td class="px-6 py-4 text-slate-400">Hidden in email replies</td>
                            <td class="px-6 py-4 text-slate-400">Buried in deep ticket tabs</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Autonomous Attention Radar</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">View Flexibility</td>
                            <td class="px-6 py-4 text-slate-400">Rows and columns only</td>
                            <td class="px-6 py-4 text-slate-400">Complex, cluttered screens</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Instant 1-Click Kanban or Table</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Learning Curve</td>
                            <td class="px-6 py-4 text-slate-400">Familiar but chaotic</td>
                            <td class="px-6 py-4 text-slate-400">Steep (requires training)</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Zero training needed</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 font-semibold text-white">Task History</td>
                            <td class="px-6 py-4 text-slate-400">None (overwritten rows)</td>
                            <td class="px-6 py-4 text-slate-400">Scattered across comment chains</td>
                            <td class="px-6 py-4 text-emerald-400 font-bold bg-emerald-950/15">Automatic chronological audit trail</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 8. SIMPLE, HONEST PRICING -->
    <section id="pricing" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Pricing Plans</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Simple Plans for Teams of Every Size</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Choose the plan that fits your current needs. Upgrade or cancel anytime.</p>
        </div>

        <!-- Elevated Pricing Horizon (Middle card rises with emerald halo) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
            <!-- Free Starter -->
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Free Starter</span>
                        <h3 class="text-2xl font-bold text-white mt-1">Free Trial</h3>
                        <p class="text-xs text-slate-400 mt-2">Explore TaskVerge with your immediate team.</p>
                    </div>
                    <div class="text-4xl font-extrabold text-white">$0 <span class="text-xs text-slate-400 font-normal">/ 14 days</span></div>
                    <ul class="text-xs sm:text-sm text-slate-300 space-y-2.5 pt-4 border-t border-slate-800">
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Up to 3 active workflows</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Visual Kanban & Table views</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Autonomous triage basics</li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-3 text-xs font-semibold text-white transition-colors">
                    Start Free Trial
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
                        <p class="text-xs text-slate-400 mt-2">Complete workflow control for fast-moving business teams.</p>
                    </div>
                    <div class="text-4xl font-extrabold text-white">$49 <span class="text-xs text-slate-400 font-normal">/ user / mo</span></div>
                    <ul class="text-xs sm:text-sm text-slate-200 space-y-2.5 pt-4 border-t border-emerald-900/60">
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> <strong>Unlimited</strong> workflows & tasks</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Real-time Intelligence Dashboard</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Predictive Bottleneck Radar</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Full chronological activity logs</li>
                    </ul>
                </div>
                <a href="{{ route('checkout', ['plan' => 'core']) }}" class="block text-center rounded-xl bg-emerald-600 hover:bg-emerald-500 py-3.5 text-xs font-bold text-white transition-all shadow-xl shadow-emerald-600/30">
                    Choose Operations Core
                </a>
            </div>

            <!-- Enterprise Scale -->
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Large Organizations</span>
                        <h3 class="text-2xl font-bold text-white mt-1">Enterprise Plan</h3>
                        <p class="text-xs text-slate-400 mt-2">For multi-department operations and custom setups.</p>
                    </div>
                    <div class="text-4xl font-extrabold text-white">$119 <span class="text-xs text-slate-400 font-normal">/ user / mo</span></div>
                    <ul class="text-xs sm:text-sm text-slate-300 space-y-2.5 pt-4 border-t border-slate-800">
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> All Operations Core features</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Self-healing pipeline orchestration</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Dedicated onboarding specialist</li>
                        <li class="flex items-center gap-2.5"><span class="text-emerald-400 font-bold">&check;</span> Priority 24/7 support</li>
                    </ul>
                </div>
                <a href="{{ route('checkout', ['plan' => 'intelligence']) }}" class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-3 text-xs font-semibold text-white transition-colors">
                    Choose Enterprise
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

    <!-- 10. FINAL CALL TO ACTION LAUNCHPAD -->
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

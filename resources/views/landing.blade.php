@extends('layouts.guest')

@section('content')
<div class="space-y-28 py-8 sm:py-16 overflow-hidden">
    <!-- 1. HERO SECTION: Autonomous Intelligence Showcase with Live Autonomous Flow Cards -->
    <section class="relative px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Ambient Neural Glows -->
        <div class="absolute -top-32 left-1/4 -translate-x-1/2 w-[600px] h-[380px] bg-emerald-500/15 rounded-full blur-[140px] pointer-events-none"></div>
        <div class="absolute top-10 right-1/4 w-[500px] h-[320px] bg-teal-500/15 rounded-full blur-[130px] pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center relative z-10">
            <!-- Left: High-Impact Autonomous Intelligence Narrative -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <!-- Eyebrow Badge -->
                <div class="inline-flex items-center gap-2.5 rounded-full border border-emerald-500/30 bg-emerald-950/40 px-4 py-1.5 text-xs font-semibold text-emerald-300 backdrop-blur-md shadow-sm">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="tracking-wide uppercase text-[11px]">Autonomous Task & Workflow Intelligence</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.15]">
                    Workflows that triage, assign, and <br>
                    <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">unblock themselves.</span>
                </h1>

                <!-- Plain English Value Pitch -->
                <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed">
                    TaskVerge combines intuitive task execution with autonomous AI agents. Our engine analyzes workload bottlenecks, auto-routes deliverables to the right specialists, and self-heals stalled pipelines before deadlines slip.
                </p>

                <!-- Action CTAs -->
                <div class="flex flex-wrap items-center gap-3 pt-2">
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
                    <a href="#how-it-works" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-800/80 bg-slate-950/60 px-4 py-3.5 text-sm font-semibold text-slate-400 hover:text-white hover:border-slate-700 transition-all">
                        <span>How It Works &darr;</span>
                    </a>
                </div>

                <!-- Reassurance Checklist -->
                <div class="pt-4 flex flex-wrap items-center gap-6 text-xs text-slate-400">
                    <span class="flex items-center gap-1.5"><strong class="text-emerald-400">&check;</strong> No credit card required</span>
                    <span class="flex items-center gap-1.5"><strong class="text-emerald-400">&check;</strong> Autonomous triage ready out of the box</span>
                    <span class="flex items-center gap-1.5"><strong class="text-emerald-400">&check;</strong> 2-minute instant onboarding</span>
                </div>
            </div>

            <!-- Right: Interactive Autonomous Flow Cards Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none space-y-4">
                    <!-- Outer Decorative Border & Mint Glow -->
                    <div class="absolute -inset-1.5 bg-gradient-to-tr from-emerald-500/20 via-teal-500/20 to-cyan-500/20 rounded-3xl blur-xl"></div>

                    <!-- Autonomous Flow Container -->
                    <div class="relative rounded-3xl border border-slate-800/90 bg-slate-950/90 p-5 backdrop-blur-xl shadow-2xl space-y-3.5">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-800/80">
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                                </span>
                                <span class="text-xs font-bold text-white uppercase tracking-wider">Autonomous AI Engine</span>
                            </div>
                            <span class="text-[10px] font-mono text-emerald-400 bg-emerald-950/60 border border-emerald-500/30 px-2 py-0.5 rounded-full">
                                Active • 3 Actions Streamed
                            </span>
                        </div>

                        <!-- Autonomous Flow Card 1: Auto-Triaged -->
                        <div class="rounded-xl border border-emerald-500/30 bg-slate-900/90 p-4 transition-all hover:border-emerald-500/60 shadow-sm group">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 rounded-md bg-emerald-500/20 px-2 py-0.5 text-[10px] font-bold text-emerald-300 uppercase tracking-wide border border-emerald-500/30">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                            Auto-Triaged
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">TSK-2041</span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white mt-1.5 group-hover:text-emerald-300 transition-colors">
                                        API Gateway Rate Limiter Upgrade
                                    </h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        Assigned to Devon Reed • Priority scored High based on sprint load.
                                    </p>
                                </div>
                                <span class="text-[10px] text-slate-500 whitespace-nowrap">Just now</span>
                            </div>
                        </div>

                        <!-- Autonomous Flow Card 2: Bottleneck Predicted -->
                        <div class="rounded-xl border border-amber-500/40 bg-slate-900/90 p-4 transition-all hover:border-amber-500/60 shadow-sm group">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 rounded-md bg-amber-500/20 px-2 py-0.5 text-[10px] font-bold text-amber-300 uppercase tracking-wide border border-amber-500/30">
                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                            Bottleneck Predicted
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">TSK-1890</span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white mt-1.5 group-hover:text-amber-300 transition-colors">
                                        Vendor Compliance Risk Assessment
                                    </h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        SLA delay risk detected 48h prior • Recommending alternate reviewer.
                                    </p>
                                </div>
                                <span class="text-[10px] text-amber-400/80 whitespace-nowrap">4m ago</span>
                            </div>
                        </div>

                        <!-- Autonomous Flow Card 3: Self-Healed -->
                        <div class="rounded-xl border border-teal-500/30 bg-slate-900/90 p-4 transition-all hover:border-teal-500/60 shadow-sm group">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 rounded-md bg-teal-500/20 px-2 py-0.5 text-[10px] font-bold text-teal-300 uppercase tracking-wide border border-teal-500/30">
                                            <span class="h-1.5 w-1.5 rounded-full bg-teal-400"></span>
                                            Self-Healed
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">TSK-1744</span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white mt-1.5 group-hover:text-teal-300 transition-colors">
                                        Cloud Infrastructure Failover Test
                                    </h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        Dependency unblocked automatically • Shifted to execution stage.
                                    </p>
                                </div>
                                <span class="text-[10px] text-teal-400 whitespace-nowrap">&check; Resolved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. ABOUT US: Visual Editorial Split -->
    <section id="about" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="rounded-3xl border border-slate-800 bg-gradient-to-b from-slate-900/80 to-slate-950 p-8 sm:p-12 lg:p-14">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Photography Column -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-800 shadow-xl aspect-[4/3] sm:aspect-square">
                        <img 
                            src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=900&q=80" 
                            alt="Team leaders reviewing project strategy in an office" 
                            class="w-full h-full object-cover object-center filter brightness-90"
                            loading="lazy"
                        />
                        <div class="absolute inset-0 bg-emerald-950/20 mix-blend-multiply"></div>
                        <div class="absolute bottom-4 left-4 right-4 p-4 rounded-xl bg-slate-950/80 backdrop-blur-md border border-slate-800 text-xs">
                            <div class="font-bold text-white">Built for High-Velocity Modern Teams</div>
                            <div class="text-slate-400 text-[11px] mt-0.5">From agile engineering units to complex multi-department enterprises.</div>
                        </div>
                    </div>
                </div>

                <!-- Narrative Column -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">About Us & Our Mission</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                            We believe task management should work for you, not the other way around.
                        </h2>
                    </div>

                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        Traditional project boards have become static graveyard lists. They require constant manual babysitting, tedious status inquiries, and endless spreadsheet cross-checks.
                    </p>

                    <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
                        We engineered <strong>TaskVerge</strong> as an autonomous workflow intelligence layer. It sits alongside your team, learning how work moves through each stage, surfacing risks before they manifest, and automatically clearing roadblocks so your people can stay in creative flow.
                    </p>

                    <!-- Three Pillar Commitments -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                        <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/60 space-y-1">
                            <div class="text-xs font-bold text-emerald-300">Autonomous Flow</div>
                            <p class="text-[11px] text-slate-400 leading-normal">Smart triage and auto-assignment without manual intervention.</p>
                        </div>
                        <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/60 space-y-1">
                            <div class="text-xs font-bold text-teal-300">Predictive Defense</div>
                            <p class="text-[11px] text-slate-400 leading-normal">Forecast bottlenecks and missed deadlines 48 hours early.</p>
                        </div>
                        <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/60 space-y-1">
                            <div class="text-xs font-bold text-cyan-300">Self-Healing Stages</div>
                            <p class="text-[11px] text-slate-400 leading-normal">Automated re-routing and fallback escalations on blockers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. WHAT IT DOES: 4 Core Autonomous Pillars with Photography Placeholders -->
    <section id="what-it-does" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">What It Does</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Autonomous Capabilities That Drive Velocity</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Replace manual micromanagement with intelligent workflow automation that keeps projects on track 24/7.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Capability 1 -->
            <div class="group rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden hover:border-emerald-500/50 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1507925921958-8a62f3d1a50d?auto=format&fit=crop&w=700&q=80" 
                        alt="Visual stage board with notes and cards" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-emerald-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Auto-Triage
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Autonomous Task Routing</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            AI instantly parses incoming tasks, assigns priority, matches the optimal team specialist, and routes to the correct workflow stage.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-emerald-400 font-medium">Smart routing algorithms &rarr;</div>
                </div>
            </div>

            <!-- Capability 2 -->
            <div class="group rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden hover:border-teal-500/50 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=700&q=80" 
                        alt="Focused professional reviewing project milestones" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-teal-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Radar
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Predictive Bottleneck Radar</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            Monitors cycle time across all stages to detect stalled dependencies and flag overdue risks 48 hours before deadlines are compromised.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-teal-400 font-medium">Early delay prevention &rarr;</div>
                </div>
            </div>

            <!-- Capability 3 -->
            <div class="group rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden hover:border-cyan-500/50 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=700&q=80" 
                        alt="Team gathered together resolving a project roadblock" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-cyan-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Self-Healing
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Self-Healing Pipelines</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            When a blocker occurs, TaskVerge automatically isolates the blocked component, triggers alternate review paths, and prompts next steps.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-cyan-400 font-medium">Automated unblocking &rarr;</div>
                </div>
            </div>

            <!-- Capability 4 -->
            <div class="group rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden hover:border-emerald-500/50 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=700&q=80" 
                        alt="Audit trail and metrics on a clean laptop screen" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-emerald-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Audit
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Automated Audit & Debriefs</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            Every transition is compiled into clean, chronological executive debriefs, eliminating manual status reporting and standup fatigue.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-emerald-400 font-medium">Zero-effort summaries &rarr;</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. HOW IT WORKS: 4 Visual Step Progression -->
    <section id="how-it-works" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Step-by-Step</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">How It Works: Autonomous Execution in 4 Steps</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">From raw incoming requests to automated delivery without manual bottlenecks.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-emerald-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-emerald-600/30">1</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Ingest</span>
                </div>
                <h3 class="text-base font-bold text-white">Connect Workflows</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Set up your team stages or import pre-configured pipelines for operations, engineering, and logistics in seconds.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-emerald-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-emerald-600/30">2</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Triage</span>
                </div>
                <h3 class="text-base font-bold text-white">Autonomous Triage</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    The AI engine automatically prioritizes new tasks, assigns owners by skill availability, and sets target milestones.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-emerald-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-emerald-600/30">3</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Monitor</span>
                </div>
                <h3 class="text-base font-bold text-white">Continuous AI Radar</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    TaskVerge continuously tracks execution velocity, detecting potential blocker patterns before work stalls.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-emerald-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-emerald-600/30">4</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Resolution</span>
                </div>
                <h3 class="text-base font-bold text-white">Self-Heal & Complete</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Blockers are either auto-routed or triaged with 1-click unblock actions, driving tasks across the finish line on time.
                </p>
            </div>
        </div>
    </section>

    <!-- 5. CREATIVE TESTIMONIALS: Real Impact From Modern Teams -->
    <section id="testimonials" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Customer Stories</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Loved by Teams Who Value Clarity</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">See how leaders in operations, engineering, and creative studios eliminated project clutter.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Testimonial 1 -->
            <div class="rounded-2xl border border-slate-800 bg-gradient-to-b from-slate-900/70 to-slate-950 p-6 flex flex-col justify-between space-y-6 hover:border-slate-700 transition-all">
                <div class="space-y-4">
                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 text-emerald-400">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm text-slate-200 leading-relaxed font-medium">
                        "Before TaskVerge, we spent 4 hours every Monday in sync meetings just trying to figure out what was stuck. Now, our dashboard highlights blockers immediately, cutting meetings down to 30 minutes."
                    </blockquote>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-slate-800/80">
                    <img 
                        src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" 
                        alt="Elena Rostova" 
                        class="h-10 w-10 rounded-full object-cover border border-emerald-500/40"
                        loading="lazy"
                    />
                    <div>
                        <div class="text-xs font-bold text-white">Elena Rostova</div>
                        <div class="text-[11px] text-slate-400">Head of Operations, NexaGrowth</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="rounded-2xl border border-emerald-500/40 bg-gradient-to-b from-emerald-950/30 via-slate-900/80 to-slate-950 p-6 flex flex-col justify-between space-y-6 shadow-xl relative">
                <div class="space-y-4">
                    <div class="flex items-center gap-1 text-emerald-400">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm text-slate-100 leading-relaxed font-medium">
                        "The autonomous triage and mandatory blocker reason features are pure genius. Developers don't just mark things 'blocked'—the engine highlights exactly what is needed and routes it."
                    </blockquote>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-emerald-900/60">
                    <img 
                        src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" 
                        alt="Marcus Chen" 
                        class="h-10 w-10 rounded-full object-cover border border-emerald-500"
                        loading="lazy"
                    />
                    <div>
                        <div class="text-xs font-bold text-white">Marcus Chen</div>
                        <div class="text-[11px] text-emerald-300">VP of Engineering, CloudCore</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="rounded-2xl border border-slate-800 bg-gradient-to-b from-slate-900/70 to-slate-950 p-6 flex flex-col justify-between space-y-6 hover:border-slate-700 transition-all">
                <div class="space-y-4">
                    <div class="flex items-center gap-1 text-emerald-400">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm text-slate-200 leading-relaxed font-medium">
                        "We replaced an enterprise tool that required a two-week onboarding course. Our client coordinators and designers were using TaskVerge within 5 minutes of sending the invites."
                    </blockquote>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-slate-800/80">
                    <img 
                        src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=150&q=80" 
                        alt="Sarah Jenkins" 
                        class="h-10 w-10 rounded-full object-cover border border-teal-500/40"
                        loading="lazy"
                    />
                    <div>
                        <div class="text-xs font-bold text-white">Sarah Jenkins</div>
                        <div class="text-[11px] text-slate-400">Managing Director, StudioCraft</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. BENEFITS: WHY YOUR TEAM WILL LOVE IT -->
    <section id="benefits" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Key Benefits</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Real Results You Can Measure</h2>
            <p class="text-sm text-slate-400 mt-2">Here is how TaskVerge saves hours of confusion every single week.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-6 space-y-3">
                <div class="text-2xl font-bold text-emerald-400">80% Fewer</div>
                <h3 class="text-base font-bold text-white">"What's the status?" Meetings</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Stop wasting hours every week asking team members where their tasks stand. Anyone can check the live board in 10 seconds.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-6 space-y-3">
                <div class="text-2xl font-bold text-amber-400">Zero</div>
                <h3 class="text-base font-bold text-white">Forgotten Blockers</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Stuck tasks no longer hide in email threads or chat messages. They stand out on the dashboard until resolved.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-6 space-y-3">
                <div class="text-2xl font-bold text-teal-400">100%</div>
                <h3 class="text-base font-bold text-white">Team Accountability</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Every task has a single owner, an explicit priority, and a clear deadline. No more guessing who was supposed to do what.
                </p>
            </div>
        </div>
    </section>

    <!-- 7. WHY WE'RE DIFFERENT FROM TRADITIONAL TOOLS -->
    <section id="why-different" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">The Difference</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Why TaskVerge Over Traditional Project Tools?</h2>
            <p class="text-sm text-slate-400 mt-2">See how TaskVerge compares to bloated legacy software and disorganized spreadsheets.</p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-900/90 text-slate-300 uppercase text-[11px] font-bold border-b border-slate-800">
                        <tr>
                            <th class="px-5 py-4">Capability</th>
                            <th class="px-5 py-4 text-slate-400">Spreadsheets & Email</th>
                            <th class="px-5 py-4 text-slate-400">Traditional Bloated Tools</th>
                            <th class="px-5 py-4 text-emerald-400 bg-emerald-950/20 font-extrabold">TaskVerge</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80 text-slate-300">
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Setup Time</td>
                            <td class="px-5 py-3.5 text-slate-400">Manual templates, breaks easily</td>
                            <td class="px-5 py-3.5 text-slate-400">Days or weeks of configuration</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-emerald-950/10">Under 2 minutes</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Blocker Detection</td>
                            <td class="px-5 py-3.5 text-slate-400">Hidden in email replies</td>
                            <td class="px-5 py-3.5 text-slate-400">Buried in deep ticket tabs</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-emerald-950/10">Autonomous Attention Radar</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">View Flexibility</td>
                            <td class="px-5 py-3.5 text-slate-400">Rows and columns only</td>
                            <td class="px-5 py-3.5 text-slate-400">Complex, cluttered screens</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-emerald-950/10">Instant 1-Click Kanban or Table</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Learning Curve</td>
                            <td class="px-5 py-3.5 text-slate-400">Familiar but chaotic</td>
                            <td class="px-5 py-3.5 text-slate-400">Steep (requires training)</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-emerald-950/10">Zero training needed</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Task History</td>
                            <td class="px-5 py-3.5 text-slate-400">None (overwritten rows)</td>
                            <td class="px-5 py-3.5 text-slate-400">Scattered across comment chains</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-emerald-950/10">Automatic chronological audit trail</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 8. SIMPLE, HONEST PRICING -->
    <section id="pricing" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Pricing Plans</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Simple Plans for Teams of Every Size</h2>
            <p class="text-sm text-slate-400 mt-2">Choose the plan that fits your current needs. Upgrade or cancel anytime.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Free Starter -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-6 space-y-4">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Free Starter</span>
                    <h3 class="text-xl font-bold text-white mt-1">Free Trial</h3>
                    <p class="text-xs text-slate-400 mt-2">Explore TaskVerge with your immediate team.</p>
                </div>
                <div class="text-3xl font-extrabold text-white">$0 <span class="text-xs text-slate-400 font-normal">/ 14 days</span></div>
                <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-slate-800">
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Up to 3 active workflows</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Visual Kanban & Table views</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Autonomous triage basics</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-2.5 text-xs font-semibold text-white transition-colors">
                    Start Free Trial
                </a>
            </div>

            <!-- Operations Core (Recommended) -->
            <div class="rounded-xl border border-emerald-500/50 bg-gradient-to-b from-emerald-950/40 to-slate-950 p-6 space-y-4 relative shadow-xl">
                <div class="absolute -top-3 right-4 rounded-full bg-emerald-600 px-3 py-0.5 text-[10px] font-bold uppercase text-white tracking-wider">
                    Most Popular
                </div>
                <div>
                    <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Growing Teams</span>
                    <h3 class="text-xl font-bold text-white mt-1">Operations Core</h3>
                    <p class="text-xs text-slate-400 mt-2">Complete workflow control for fast-moving business teams.</p>
                </div>
                <div class="text-3xl font-extrabold text-white">$49 <span class="text-xs text-slate-400 font-normal">/ user / mo</span></div>
                <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-emerald-900/60">
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> <strong>Unlimited</strong> workflows & tasks</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Real-time Intelligence Dashboard</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Predictive Bottleneck Radar</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Full chronological activity logs</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'core']) }}" class="block text-center rounded-xl bg-emerald-600 hover:bg-emerald-500 py-2.5 text-xs font-bold text-white transition-colors shadow">
                    Choose Operations Core
                </a>
            </div>

            <!-- Enterprise Scale -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-6 space-y-4">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Large Organizations</span>
                    <h3 class="text-xl font-bold text-white mt-1">Enterprise Plan</h3>
                    <p class="text-xs text-slate-400 mt-2">For multi-department operations and custom setups.</p>
                </div>
                <div class="text-3xl font-extrabold text-white">$119 <span class="text-xs text-slate-400 font-normal">/ user / mo</span></div>
                <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-slate-800">
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> All Operations Core features</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Self-healing pipeline orchestration</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Dedicated onboarding specialist</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Priority 24/7 support</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'intelligence']) }}" class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-2.5 text-xs font-semibold text-white transition-colors">
                    Choose Enterprise
                </a>
            </div>
        </div>
    </section>

    <!-- 9. FREQUENTLY ASKED QUESTIONS (FAQ) -->
    <section id="faq" class="px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">FAQ</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Common Questions Answered</h2>
        </div>

        <div class="space-y-4">
            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
                <h3 class="text-sm font-bold text-white">How does the autonomous task routing work?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    TaskVerge evaluates incoming tasks against team capacity, department skills, and active commitments, automatically tagging priority and routing each task to the best-suited stage and owner.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
                <h3 class="text-sm font-bold text-white">Can I switch between Kanban boards and List tables?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Yes! Every workflow comes with an instant dual-view toggle. You can view your project as a visual card board or as an organized data table whenever you like.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
                <h3 class="text-sm font-bold text-white">What is the Predictive Bottleneck Radar?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    The radar tracks how long cards linger in review or pending stages. If progress slows down relative to historical sprint norms, it raises early warning flags 48 hours in advance so managers can unblock before due dates are breached.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
                <h3 class="text-sm font-bold text-white">Can I try TaskVerge before buying?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Absolutely. You can start a free trial with no credit card required, or test our live demo personas directly on the login page.
                </p>
            </div>
        </div>
    </section>

    <!-- 10. FINAL CALL TO ACTION -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="rounded-2xl border border-slate-800 bg-gradient-to-r from-emerald-950/60 via-teal-950/40 to-slate-950 p-8 sm:p-12 text-center space-y-6 shadow-2xl">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Ready for autonomous workflow intelligence?</h2>
            <p class="text-sm text-slate-300 max-w-xl mx-auto leading-relaxed">
                Join teams who organize their daily work with visual clarity, fast autonomous triage, and zero clutter.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('register') }}" class="rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-500 transition-colors shadow-lg shadow-emerald-600/30">
                    Get Started Free
                </a>
                <a href="{{ route('login') }}" class="rounded-xl border border-slate-700 bg-slate-900 px-6 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800 hover:text-white transition-colors">
                    Explore Live Workspace
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

@extends('layouts.guest')

@section('content')
<div class="space-y-28 py-8 sm:py-16 overflow-hidden">
    <!-- 1. HERO SECTION: Dynamic Split with Photography & Floating Glass Cards -->
    <section class="relative px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Ambient Background Glows -->
        <div class="absolute -top-32 left-1/4 -translate-x-1/2 w-[550px] h-[350px] bg-indigo-500/15 rounded-full blur-[130px] pointer-events-none"></div>
        <div class="absolute top-10 right-1/4 w-[450px] h-[300px] bg-purple-500/15 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center relative z-10">
            <!-- Left: High-Impact Commercial Copy -->
            <div class="lg:col-span-7 space-y-6 text-left">
                <!-- Eyebrow Badge -->
                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-3.5 py-1 text-xs font-semibold text-indigo-300 backdrop-blur-md">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Modern Workflow Intelligence</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.15]">
                    Stop chasing updates. <br>
                    <span class="bg-gradient-to-r from-indigo-400 via-purple-300 to-emerald-400 bg-clip-text text-transparent">Get work done together.</span>
                </h1>

                <!-- Plain English Value Pitch -->
                <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed">
                    TaskVerge gives your entire team a clear, shared visual workspace. See who is working on what, track tasks as they move across stages, and solve blockers before they derail deadlines.
                </p>

                <!-- Action CTAs -->
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2.5 rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:bg-indigo-500 transition-all scale-100 hover:scale-[1.02]">
                            <span>Open Your Dashboard</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2.5 rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-indigo-600/30 hover:bg-indigo-500 transition-all scale-100 hover:scale-[1.02]">
                            <span>Start Free 14-Day Trial</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-900/90 px-5 py-3.5 text-sm font-semibold text-slate-200 hover:bg-slate-800 hover:text-white transition-all">
                            <span>Test Live Personas</span>
                        </a>
                    @endauth
                    <a href="#how-it-works" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-800/80 bg-slate-950/60 px-4 py-3.5 text-sm font-semibold text-slate-400 hover:text-white hover:border-slate-700 transition-all">
                        <span>How It Works &darr;</span>
                    </a>
                </div>

                <!-- Reassurance Checklist -->
                <div class="pt-4 flex flex-wrap items-center gap-6 text-xs text-slate-400">
                    <span class="flex items-center gap-1.5"><strong class="text-emerald-400">&check;</strong> No credit card required</span>
                    <span class="flex items-center gap-1.5"><strong class="text-emerald-400">&check;</strong> 2-minute instant onboarding</span>
                    <span class="flex items-center gap-1.5"><strong class="text-emerald-400">&check;</strong> Full team collaboration</span>
                </div>
            </div>

            <!-- Right: Curated Hero Photography with Floating Glass Widgets -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    <!-- Outer Decorative Border & Shadow Glow -->
                    <div class="absolute -inset-1.5 bg-gradient-to-tr from-indigo-500/30 to-purple-500/30 rounded-3xl blur-lg"></div>

                    <!-- Main Hero Image Frame -->
                    <div class="relative rounded-3xl overflow-hidden border border-slate-800 bg-slate-900 shadow-2xl aspect-[4/3] sm:aspect-[16/11]">
                        <img 
                            src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80" 
                            alt="Modern collaborative team working on workflow planning" 
                            class="w-full h-full object-cover object-center filter brightness-95 contrast-105"
                            loading="eager"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                    </div>

                    <!-- Floating Glass Card 1: Live Sprint Badge (Top Right) -->
                    <div class="absolute -top-5 -right-4 sm:-right-6 rounded-2xl border border-slate-700/70 bg-slate-900/90 backdrop-blur-md p-3.5 shadow-2xl max-w-[210px] hidden sm:block">
                        <div class="flex items-center gap-2.5">
                            <div class="h-8 w-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs">
                                98%
                            </div>
                            <div>
                                <div class="text-[11px] font-bold text-white">Sprint Velocity</div>
                                <div class="text-[10px] text-slate-400">Tasks delivered on schedule</div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Glass Card 2: Blocker Resolution Alert (Bottom Left) -->
                    <div class="absolute -bottom-6 -left-4 sm:-left-6 rounded-2xl border border-rose-500/40 bg-slate-900/95 backdrop-blur-md p-3.5 shadow-2xl max-w-[240px]">
                        <div class="flex items-start gap-2.5">
                            <span class="flex h-2.5 w-2.5 rounded-full bg-rose-500 mt-1 animate-ping"></span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-rose-400">Immediate Triage</span>
                                    <span class="text-[9px] text-slate-400">2 min ago</span>
                                </div>
                                <div class="text-xs font-semibold text-white mt-0.5">Blocker Resolved: Legal Review</div>
                                <div class="text-[10px] text-emerald-400 mt-1 flex items-center gap-1 font-medium">
                                    <span>&check; Stage Unblocked</span>
                                </div>
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
                        <div class="absolute inset-0 bg-indigo-950/20 mix-blend-multiply"></div>
                        <div class="absolute bottom-4 left-4 right-4 p-4 rounded-xl bg-slate-950/80 backdrop-blur-md border border-slate-800 text-xs">
                            <div class="font-bold text-white">Built for High-Clarity Teams</div>
                            <div class="text-slate-400 text-[11px] mt-0.5">From fast-scaling startups to multi-department enterprises.</div>
                        </div>
                    </div>
                </div>

                <!-- Narrative Column -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">About Our Purpose</span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight">
                            We believe project management shouldn't feel like a second job.
                        </h2>
                    </div>

                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        Traditional tools have become bloated with dozens of menus, endless custom fields, and steep learning curves. Teams end up spending more time organizing tickets than actually getting real work done.
                    </p>

                    <p class="text-sm sm:text-base text-slate-400 leading-relaxed">
                        We built <strong>TaskVerge</strong> with one clear mission: give every team member and manager the fastest path from task creation to completion. A clutter-free space where work is visible, ownership is indisputable, and blockers are resolved before they delay outcomes.
                    </p>

                    <!-- Three Pillar Commitments -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                        <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/60 space-y-1">
                            <div class="text-xs font-bold text-indigo-300">Simplicity First</div>
                            <p class="text-[11px] text-slate-400 leading-normal">Zero configuration required. Teams get moving in minutes.</p>
                        </div>
                        <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/60 space-y-1">
                            <div class="text-xs font-bold text-emerald-300">Total Visibility</div>
                            <p class="text-[11px] text-slate-400 leading-normal">Switch between Kanban and Table views with one click.</p>
                        </div>
                        <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/60 space-y-1">
                            <div class="text-xs font-bold text-rose-300">Instant Unblocking</div>
                            <p class="text-[11px] text-slate-400 leading-normal">Mandatory reasons ensure issues get resolved immediately.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. WHAT IT DOES: 4 Core Pillars with Photography Placeholders -->
    <section id="what-it-does" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">What It Does</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Everything You Need to Run Clean Workflows</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">No complicated setup. Just the essential tools that keep projects organized, accountable, and moving forward.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Feature 1 -->
            <div class="group rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden hover:border-slate-700 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1507925921958-8a62f3d1a50d?auto=format&fit=crop&w=700&q=80" 
                        alt="Visual stage board with notes and cards" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-indigo-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Pipelines
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Visual Stage Boards</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            Organize your work into customizable stages (Planning, In Progress, Review, Done). Shift tasks instantly across columns.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-indigo-400 font-medium">Dual Kanban & Table views &rarr;</div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="group rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden hover:border-slate-700 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=700&q=80" 
                        alt="Focused professional reviewing project milestones" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-emerald-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Ownership
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Clear Accountability</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            Every task has a single owner, an explicit priority level, and an actionable deadline. Zero ambiguity about responsibility.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-emerald-400 font-medium">Clear role assignment &rarr;</div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="group rounded-2xl border border-rose-500/30 bg-slate-950 overflow-hidden hover:border-rose-500/50 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=700&q=80" 
                        alt="Team gathered together resolving a project roadblock" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-rose-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Triage
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Built-in Blocker Alerts</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            Stuck team members flag tasks with a reason. Managers receive immediate priority alerts in the Urgent Attention Queue.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-rose-400 font-medium">1-Click unblock triage &rarr;</div>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="group rounded-2xl border border-slate-800 bg-slate-950 overflow-hidden hover:border-slate-700 transition-all flex flex-col">
                <div class="h-44 overflow-hidden relative">
                    <img 
                        src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=700&q=80" 
                        alt="Audit trail and metrics on a clean laptop screen" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute top-3 left-3 rounded-lg bg-purple-600/90 backdrop-blur-md px-2.5 py-1 text-[11px] font-bold text-white">
                        Audit
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-2">
                    <div>
                        <h3 class="text-base font-bold text-white">Chronological History</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mt-1.5">
                            Every transition, status change, blocker comment, and reassignment is recorded automatically in an immutable chronological feed.
                        </p>
                    </div>
                    <div class="pt-2 text-[11px] text-purple-400 font-medium">100% audit transparency &rarr;</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. HOW IT WORKS: 4 Visual Step Progression -->
    <section id="how-it-works" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Step-by-Step</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Get Started in 4 Easy Steps</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">Zero training required. If your team can move a card, they already know how to use TaskVerge.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-indigo-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-indigo-600/30">1</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Setup</span>
                </div>
                <h3 class="text-base font-bold text-white">Create a Workflow</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Set up custom pipelines matching your team's real workflow—from design sprints to procurement reviews.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-indigo-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-indigo-600/30">2</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Delegation</span>
                </div>
                <h3 class="text-base font-bold text-white">Add & Assign Tasks</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Define objectives, attach team members, select priority flags, and set realistic target deadlines.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-indigo-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-indigo-600/30">3</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Execution</span>
                </div>
                <h3 class="text-base font-bold text-white">Drive Progress</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Team members drag cards across stages as deliverables advance, keeping everyone in sync effortlessly.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 space-y-4 relative">
                <div class="flex items-center justify-between">
                    <span class="h-9 w-9 rounded-xl bg-indigo-600 text-white font-extrabold text-sm flex items-center justify-center shadow-md shadow-indigo-600/30">4</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase">Resolution</span>
                </div>
                <h3 class="text-base font-bold text-white">Unblock Blockers</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Triage flagged blockers directly from the Urgent Attention Queue to keep delivery velocity humming.
                </p>
            </div>
        </div>
    </section>

    <!-- 5. CREATIVE TESTIMONIALS: Real Impact From Modern Teams -->
    <section id="testimonials" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Customer Stories</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-1">Loved by Teams Who Value Clarity</h2>
            <p class="text-sm sm:text-base text-slate-400 mt-2">See how leaders in operations, engineering, and creative studios eliminated project clutter.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Testimonial 1 -->
            <div class="rounded-2xl border border-slate-800 bg-gradient-to-b from-slate-900/70 to-slate-950 p-6 flex flex-col justify-between space-y-6 hover:border-slate-700 transition-all">
                <div class="space-y-4">
                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 text-amber-400">
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
                        class="h-10 w-10 rounded-full object-cover border border-indigo-500/40"
                        loading="lazy"
                    />
                    <div>
                        <div class="text-xs font-bold text-white">Elena Rostova</div>
                        <div class="text-[11px] text-slate-400">Head of Operations, NexaGrowth</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="rounded-2xl border border-indigo-500/40 bg-gradient-to-b from-indigo-950/30 via-slate-900/80 to-slate-950 p-6 flex flex-col justify-between space-y-6 shadow-xl relative">
                <div class="space-y-4">
                    <div class="flex items-center gap-1 text-amber-400">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm text-slate-100 leading-relaxed font-medium">
                        "The mandatory blocker reason feature is pure genius. Developers don't just mark things 'blocked'—they state exactly what they need. It eliminated days of email back-and-forth across departments."
                    </blockquote>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-indigo-900/60">
                    <img 
                        src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" 
                        alt="Marcus Chen" 
                        class="h-10 w-10 rounded-full object-cover border border-indigo-500"
                        loading="lazy"
                    />
                    <div>
                        <div class="text-xs font-bold text-white">Marcus Chen</div>
                        <div class="text-[11px] text-indigo-300">VP of Engineering, CloudCore</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="rounded-2xl border border-slate-800 bg-gradient-to-b from-slate-900/70 to-slate-950 p-6 flex flex-col justify-between space-y-6 hover:border-slate-700 transition-all">
                <div class="space-y-4">
                    <div class="flex items-center gap-1 text-amber-400">
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
                        class="h-10 w-10 rounded-full object-cover border border-emerald-500/40"
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

    <!-- 5. BENEFITS: WHY YOUR TEAM WILL LOVE IT -->
    <section id="benefits" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Key Benefits</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Real Results You Can Measure</h2>
            <p class="text-sm text-slate-400 mt-2">Here is how TaskVerge saves hours of confusion every single week.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-6 space-y-3">
                <div class="text-2xl font-bold text-indigo-400">80% Fewer</div>
                <h3 class="text-base font-bold text-white">"What's the status?" Meetings</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Stop wasting hours every week asking team members where their tasks stand. Anyone can check the live board in 10 seconds.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-6 space-y-3">
                <div class="text-2xl font-bold text-rose-400">Zero</div>
                <h3 class="text-base font-bold text-white">Forgotten Blockers</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Stuck tasks no longer hide in email threads or chat messages. They stand out on the dashboard until resolved.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-6 space-y-3">
                <div class="text-2xl font-bold text-emerald-400">100%</div>
                <h3 class="text-base font-bold text-white">Team Accountability</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Every task has a single owner, an explicit priority, and a clear deadline. No more guessing who was supposed to do what.
                </p>
            </div>
        </div>
    </section>

    <!-- 6. WHY WE'RE DIFFERENT FROM TRADITIONAL TOOLS -->
    <section id="why-different" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">The Difference</span>
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
                            <th class="px-5 py-4 text-indigo-400 bg-indigo-950/20 font-extrabold">TaskVerge</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80 text-slate-300">
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Setup Time</td>
                            <td class="px-5 py-3.5 text-slate-400">Manual templates, breaks easily</td>
                            <td class="px-5 py-3.5 text-slate-400">Days or weeks of configuration</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-indigo-950/10">Under 2 minutes</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Blocker Detection</td>
                            <td class="px-5 py-3.5 text-slate-400">Hidden in email replies</td>
                            <td class="px-5 py-3.5 text-slate-400">Buried in deep ticket tabs</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-indigo-950/10">Dedicated Urgent Attention Queue</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">View Flexibility</td>
                            <td class="px-5 py-3.5 text-slate-400">Rows and columns only</td>
                            <td class="px-5 py-3.5 text-slate-400">Complex, cluttered screens</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-indigo-950/10">Instant 1-Click Kanban or Table</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Learning Curve</td>
                            <td class="px-5 py-3.5 text-slate-400">Familiar but chaotic</td>
                            <td class="px-5 py-3.5 text-slate-400">Steep (requires training)</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-indigo-950/10">Zero training needed</td>
                        </tr>
                        <tr>
                            <td class="px-5 py-3.5 font-semibold text-white">Task History</td>
                            <td class="px-5 py-3.5 text-slate-400">None (overwritten rows)</td>
                            <td class="px-5 py-3.5 text-slate-400">Scattered across comment chains</td>
                            <td class="px-5 py-3.5 text-emerald-400 font-bold bg-indigo-950/10">Automatic chronological audit trail</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 7. SIMPLE, HONEST PRICING -->
    <section id="pricing" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Pricing Plans</span>
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
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Blocker tracking</li>
                </ul>
                <a href="{{ route('register') }}" class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-2.5 text-xs font-semibold text-white transition-colors">
                    Start Free Trial
                </a>
            </div>

            <!-- Operations Core (Recommended) -->
            <div class="rounded-xl border border-indigo-500/50 bg-gradient-to-b from-indigo-950/40 to-slate-950 p-6 space-y-4 relative shadow-xl">
                <div class="absolute -top-3 right-4 rounded-full bg-indigo-600 px-3 py-0.5 text-[10px] font-bold uppercase text-white tracking-wider">
                    Most Popular
                </div>
                <div>
                    <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Growing Teams</span>
                    <h3 class="text-xl font-bold text-white mt-1">Operations Core</h3>
                    <p class="text-xs text-slate-400 mt-2">Complete workflow control for fast-moving business teams.</p>
                </div>
                <div class="text-3xl font-extrabold text-white">$49 <span class="text-xs text-slate-400 font-normal">/ user / mo</span></div>
                <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-indigo-900/60">
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> <strong>Unlimited</strong> workflows & tasks</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Real-time Operations Dashboard</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Urgent Attention & Triage Queue</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Full chronological activity logs</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'core']) }}" class="block text-center rounded-xl bg-indigo-600 hover:bg-indigo-500 py-2.5 text-xs font-bold text-white transition-colors shadow">
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
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Advanced priority SLA tracking</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Dedicated onboarding specialist</li>
                    <li class="flex items-center gap-2"><span class="text-emerald-400 font-bold">&check;</span> Priority 24/7 support</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'intelligence']) }}" class="block text-center rounded-xl bg-slate-800 hover:bg-slate-700 py-2.5 text-xs font-semibold text-white transition-colors">
                    Choose Enterprise
                </a>
            </div>
        </div>
    </section>

    <!-- 8. FREQUENTLY ASKED QUESTIONS (FAQ) -->
    <section id="faq" class="px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">FAQ</span>
            <h2 class="text-3xl font-extrabold text-white mt-1">Common Questions Answered</h2>
        </div>

        <div class="space-y-4">
            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
                <h3 class="text-sm font-bold text-white">Can I switch between Kanban boards and List tables?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Yes! Every workflow comes with an instant dual-view toggle. You can view your project as a visual card board or as an organized data table whenever you like.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
                <h3 class="text-sm font-bold text-white">What happens when someone marks a task as blocked?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    When a team member marks a task blocked, TaskVerge prompts them for a brief explanation. That task is immediately highlighted in red on the team's Urgent Attention Queue so managers can step in and unblock it before deadlines are missed.
                </p>
            </div>

            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 space-y-2">
                <h3 class="text-sm font-bold text-white">How long does it take for my team to get started?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Less than two minutes. Create your account, create a workflow or use one of our templates, and invite your team. There is no complicated configuration.
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

    <!-- 9. FINAL CALL TO ACTION -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="rounded-2xl border border-slate-800 bg-gradient-to-r from-indigo-950/60 via-purple-950/40 to-slate-950 p-8 sm:p-12 text-center space-y-6 shadow-2xl">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Ready to make workflow management simple?</h2>
            <p class="text-sm text-slate-300 max-w-xl mx-auto leading-relaxed">
                Join teams who organize their daily work with visual clarity, fast blocker detection, and zero clutter.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('register') }}" class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white hover:bg-indigo-500 transition-colors shadow-lg shadow-indigo-600/30">
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

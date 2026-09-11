@extends('layouts.guest')

@section('content')
<div class="space-y-24 py-8 sm:py-16">
    <!-- 1. HERO SECTION -->
    <section class="relative overflow-hidden px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Background Ambient Glow -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-emerald-500/20 blur-[120px] pointer-events-none"></div>

        <div class="text-center space-y-6 max-w-4xl mx-auto relative z-10">
            <!-- Version & NVIDIA Badge -->
            <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-3.5 py-1 text-xs font-semibold text-indigo-300 backdrop-blur-md">
                <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>TaskVerge Enterprise 2.8</span>
                <span class="text-slate-500">&bull;</span>
                <span class="text-emerald-400">Accelerated by NVIDIA AI Technology</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                Enterprise Workflow Intelligence & <span class="bg-gradient-to-r from-indigo-400 via-purple-300 to-emerald-400 bg-clip-text text-transparent">Operational Governance</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Eliminate fractured spreadsheets, invisible delays, and untracked bottlenecks. Centralize task ownership, automate multi-stage pipelines, and ensure end-to-end operational traceability.
            </p>

            <!-- Call to Actions -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 transition-all scale-100 hover:scale-105">
                        Open Enterprise Dashboard
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/30 hover:bg-indigo-500 transition-all scale-100 hover:scale-105">
                        Launch Live Workspace
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-900/90 px-6 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800 hover:text-white transition-all">
                        Try 1-Click Personas
                    </a>
                @endauth
                <a href="#nvidia-foundation" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-800/80 bg-slate-950/60 px-5 py-3 text-sm font-semibold text-slate-300 hover:border-slate-700 hover:text-white transition-all">
                    <span>NVIDIA Foundation</span>
                    <svg class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>
            </div>

            <!-- Quick Metrics Ticker -->
            <div class="pt-8 grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto border-t border-slate-800/80 text-left">
                <div class="p-3 rounded-lg bg-slate-950/60 border border-slate-800">
                    <span class="block text-2xl font-extrabold text-white">100%</span>
                    <span class="text-xs text-slate-400 font-medium">Audit Traceability</span>
                </div>
                <div class="p-3 rounded-lg bg-slate-950/60 border border-slate-800">
                    <span class="block text-2xl font-extrabold text-indigo-400">&lt; 5ms</span>
                    <span class="text-xs text-slate-400 font-medium">Triton Inference SLA</span>
                </div>
                <div class="p-3 rounded-lg bg-slate-950/60 border border-slate-800">
                    <span class="block text-2xl font-extrabold text-emerald-400">Zero</span>
                    <span class="text-xs text-slate-400 font-medium">Untracked Bottlenecks</span>
                </div>
                <div class="p-3 rounded-lg bg-slate-950/60 border border-slate-800">
                    <span class="block text-2xl font-extrabold text-purple-400">SOC2 & ISO</span>
                    <span class="text-xs text-slate-400 font-medium">Compliance Ready</span>
                </div>
            </div>
        </div>

        <!-- Interactive Platform Live Preview Graphic -->
        <div class="mt-14 max-w-5xl mx-auto rounded-2xl border border-slate-800 bg-slate-950 shadow-2xl overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-800 bg-slate-900/90 px-4 py-3">
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-rose-500/80"></div>
                    <div class="h-3 w-3 rounded-full bg-amber-500/80"></div>
                    <div class="h-3 w-3 rounded-full bg-emerald-500/80"></div>
                    <span class="ml-2 text-xs font-mono text-slate-400">taskverge.internal/app/operational-intelligence</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-[10px] text-emerald-400 font-mono">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        TELEMETRY CONNECTED
                    </span>
                </div>
            </div>

            <!-- Preview Dashboard UI Elements -->
            <div class="p-6 bg-gradient-to-b from-slate-950 to-slate-900 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 rounded-xl border border-slate-800 bg-slate-900/60">
                        <div class="text-xs text-slate-400 font-semibold uppercase">Active Pipelines</div>
                        <div class="text-2xl font-bold text-white mt-1">Enterprise Cloud Migration</div>
                        <div class="w-full bg-slate-800 h-1.5 rounded-full mt-3 overflow-hidden">
                            <div class="bg-indigo-500 h-full rounded-full" style="width: 78%"></div>
                        </div>
                    </div>
                    <div class="p-4 rounded-xl border border-rose-500/30 bg-rose-950/20">
                        <div class="text-xs text-rose-400 font-semibold uppercase">Interception Alert</div>
                        <div class="text-base font-bold text-rose-200 mt-1">TSK-1001: Triton Cluster Quota</div>
                        <p class="text-xs text-rose-300 mt-1">Blocked &bull; Vendor quota hold escalated</p>
                    </div>
                    <div class="p-4 rounded-xl border border-emerald-500/30 bg-emerald-950/20">
                        <div class="text-xs text-emerald-400 font-semibold uppercase">NVIDIA Inference Engine</div>
                        <div class="text-base font-bold text-emerald-200 mt-1">Nemotron-70B Active</div>
                        <p class="text-xs text-emerald-300 mt-1">Predictive path convergence at 98.4%</p>
                    </div>
                </div>

                <!-- Pipeline Stages Mockup -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                    <div class="p-3 rounded-lg border border-slate-800 bg-slate-950/80">
                        <span class="font-bold text-slate-400 uppercase tracking-wider text-[10px]">1. Intake</span>
                        <div class="mt-2 font-medium text-slate-200">5 Tasks in Review</div>
                    </div>
                    <div class="p-3 rounded-lg border border-blue-500/30 bg-blue-950/20">
                        <span class="font-bold text-blue-400 uppercase tracking-wider text-[10px]">2. Processing</span>
                        <div class="mt-2 font-medium text-blue-200">8 Tasks In Progress</div>
                    </div>
                    <div class="p-3 rounded-lg border border-rose-500/30 bg-rose-950/20">
                        <span class="font-bold text-rose-400 uppercase tracking-wider text-[10px]">3. Blocked Triage</span>
                        <div class="mt-2 font-medium text-rose-200">2 Bottlenecks Flagged</div>
                    </div>
                    <div class="p-3 rounded-lg border border-emerald-500/30 bg-emerald-950/20">
                        <span class="font-bold text-emerald-400 uppercase tracking-wider text-[10px]">4. Completed</span>
                        <div class="mt-2 font-medium text-emerald-200">14 Verified Sign-offs</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. ENTERPRISE AUTOMATION USE CASES -->
    <section id="overview" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-xs font-semibold uppercase tracking-widest text-indigo-400">Enterprise Operations</h2>
            <p class="text-3xl font-extrabold text-white mt-1">Engineered for Complex Cross-Functional Workflows</p>
            <p class="text-sm text-slate-400 mt-3">From infrastructure migrations to cross-border logistics, TaskVerge replaces chaotic communications with structured, accountable execution.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Use Case 1 -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-6 space-y-3 hover:border-slate-700 transition-all">
                <div class="h-10 w-10 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <h3 class="text-base font-bold text-white">Hybrid Cloud & SRE Operations</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Coordinate multi-region Kubernetes rollouts, database migrations, GPU inference clusters, and incident remediation with strict stage gates and zero-downtime requirements.
                </p>
                <div class="pt-2 flex items-center gap-2 text-[11px] text-indigo-400 font-medium">
                    <span>SRE Runbook Execution</span> &bull; <span>Stage Hand-offs</span>
                </div>
            </div>

            <!-- Use Case 2 -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-6 space-y-3 hover:border-slate-700 transition-all">
                <div class="h-10 w-10 rounded-lg bg-emerald-600/20 text-emerald-400 flex items-center justify-center font-bold">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-base font-bold text-white">Global Supply Chain & Freight</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Track international shipping manifests, customs inspections, quarantine holds, and distribution cross-docking with instant blocker escalation to senior managers.
                </p>
                <div class="pt-2 flex items-center gap-2 text-[11px] text-emerald-400 font-medium">
                    <span>Port Clearance Triage</span> &bull; <span>Customs Verification</span>
                </div>
            </div>

            <!-- Use Case 3 -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-6 space-y-3 hover:border-slate-700 transition-all">
                <div class="h-10 w-10 rounded-lg bg-purple-600/20 text-purple-400 flex items-center justify-center font-bold">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-base font-bold text-white">Regulatory Compliance & Audits</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Satisfy SOC2 Type II, ISO 27001, and HIPAA compliance mandates through immutable task audit histories, mandatory justification on status changes, and operator sign-offs.
                </p>
                <div class="pt-2 flex items-center gap-2 text-[11px] text-purple-400 font-medium">
                    <span>100% Audit Logging</span> &bull; <span>Evidence Records</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. NVIDIA TECHNOLOGY SHOWCASE (DEDICATED SECTION) -->
    <section id="nvidia-foundation" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="rounded-2xl border border-emerald-500/30 bg-gradient-to-b from-slate-950 via-slate-950/90 to-emerald-950/20 p-8 sm:p-12 shadow-2xl relative overflow-hidden">
            <div class="max-w-3xl mb-12">
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-400">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Technology Foundation Showcase</span>
                </div>
                <h2 class="text-3xl font-extrabold text-white mt-3">Powered by NVIDIA Enterprise AI Infrastructure</h2>
                <p class="text-sm text-slate-300 mt-2 leading-relaxed">
                    TaskVerge incorporates state-of-the-art NVIDIA enterprise technologies to empower workflow intelligence, predictive bottleneck identification, low-latency inference, and model customization.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- NeMo -->
                <div class="rounded-xl border border-slate-800 bg-slate-900/80 p-5 space-y-3 hover:border-emerald-500/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-emerald-400 uppercase">Workflow AI</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">NeMo</span>
                    </div>
                    <h3 class="text-base font-bold text-white group-hover:text-emerald-300 transition-colors">NVIDIA NeMo</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Supports the end-to-end development, fine-tuning, and enterprise domain customization of AI workflows, operational guardrails, and automated reasoning pipelines.
                    </p>
                    <ul class="text-[11px] text-slate-400 space-y-1.5 pt-2 border-t border-slate-800">
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Domain policy alignment</li>
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Guardrail enforcement</li>
                    </ul>
                </div>

                <!-- Nemotron -->
                <div class="rounded-xl border border-slate-800 bg-slate-900/80 p-5 space-y-3 hover:border-emerald-500/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-emerald-400 uppercase">Reasoning Engine</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">Nemotron</span>
                    </div>
                    <h3 class="text-base font-bold text-white group-hover:text-emerald-300 transition-colors">NVIDIA Nemotron</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Provides high-parameter foundation reasoning capabilities for enterprise-oriented language analysis, cross-workflow dependency mapping, and automated task synthesis.
                    </p>
                    <ul class="text-[11px] text-slate-400 space-y-1.5 pt-2 border-t border-slate-800">
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Complex task parsing</li>
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Root cause bottleneck logic</li>
                    </ul>
                </div>

                <!-- NIM -->
                <div class="rounded-xl border border-slate-800 bg-slate-900/80 p-5 space-y-3 hover:border-emerald-500/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-emerald-400 uppercase">Microservices</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">NIM</span>
                    </div>
                    <h3 class="text-base font-bold text-white group-hover:text-emerald-300 transition-colors">NVIDIA NIM</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Supports seamless deployment of optimized AI models through production-ready inference microservices with enterprise standard APIs and containerized security.
                    </p>
                    <ul class="text-[11px] text-slate-400 space-y-1.5 pt-2 border-t border-slate-800">
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Air-gapped & VPC ready</li>
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Turnkey standard API schemas</li>
                    </ul>
                </div>

                <!-- Triton -->
                <div class="rounded-xl border border-slate-800 bg-slate-900/80 p-5 space-y-3 hover:border-emerald-500/50 transition-all group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-emerald-400 uppercase">Serving System</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">Triton</span>
                    </div>
                    <h3 class="text-base font-bold text-white group-hover:text-emerald-300 transition-colors">NVIDIA Triton</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Supports scalable model inference and efficient serving of computational workloads across multi-GPU nodes with concurrent model execution and dynamic batching.
                    </p>
                    <ul class="text-[11px] text-slate-400 space-y-1.5 pt-2 border-t border-slate-800">
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Dynamic request batching</li>
                        <li class="flex items-center gap-1.5"><span class="h-1 w-1 rounded-full bg-emerald-400"></span> Sub-millisecond latency</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. TECHNICAL ARCHITECTURE SPECIFICATION -->
    <section id="architecture" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-xs font-semibold uppercase tracking-widest text-indigo-400">System Topology</h2>
            <p class="text-3xl font-extrabold text-white mt-1">Robust Enterprise Technical Architecture</p>
            <p class="text-sm text-slate-400 mt-2">Built on proven enterprise frameworks with decoupled reactivity, strict relational persistence, and clean integration boundaries.</p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 sm:p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl border border-indigo-500/30 bg-indigo-950/20">
                    <div class="text-[11px] font-bold text-indigo-400 uppercase tracking-wider">Frontend Interface</div>
                    <div class="text-base font-bold text-white mt-1">Livewire 3 + Tailwind CSS</div>
                    <p class="text-xs text-slate-400 mt-2">Real-time reactive DOM synchronization, dynamic Kanban rendering, and client-side instant filtering.</p>
                </div>

                <div class="p-4 rounded-xl border border-purple-500/30 bg-purple-950/20">
                    <div class="text-[11px] font-bold text-purple-400 uppercase tracking-wider">Backend Application Layer</div>
                    <div class="text-base font-bold text-white mt-1">PHP 8.5 / Laravel Core</div>
                    <p class="text-xs text-slate-400 mt-2">Enterprise business logic, role-based authorization policies, automated stage validation, and activity logging.</p>
                </div>

                <div class="p-4 rounded-xl border border-blue-500/30 bg-blue-950/20">
                    <div class="text-[11px] font-bold text-blue-400 uppercase tracking-wider">Storage & Consistency</div>
                    <div class="text-base font-bold text-white mt-1">MySQL Enterprise Engine</div>
                    <p class="text-xs text-slate-400 mt-2">ACID transactions, relational integrity, immutable audit records, and optimized index execution.</p>
                </div>

                <div class="p-4 rounded-xl border border-emerald-500/30 bg-emerald-950/20">
                    <div class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider">Inference Acceleration</div>
                    <div class="text-base font-bold text-white mt-1">NVIDIA Triton / NIM Layer</div>
                    <p class="text-xs text-slate-400 mt-2">Microservices connector for predictive bottleneck forecasting and SLA telemetry.</p>
                </div>
            </div>

            <!-- Architecture Flow Diagram -->
            <div class="p-6 rounded-xl border border-slate-800 bg-slate-900/60 font-mono text-xs text-slate-300 overflow-x-auto">
                <div class="text-slate-400 mb-2 uppercase text-[10px] tracking-wider font-sans font-semibold">Data & Telemetry Flow:</div>
                <pre class="leading-relaxed">
[ Operator / Manager Browser ] 
          │ (Livewire 3 WebSocket / Morphdom Sync)
          ▼
[ Laravel Application Router & RBAC Gatekeeper ]
          ├── Admin / Manager / Operator Policies
          ├── Workflow Stage Validation Engine
          │
          ├──► [ MySQL Relational Database ] (Workflows, Stages, Tasks, Immutable Audit Trail)
          │
          └──► [ AI Integration Layer ]
                    ├── NVIDIA NIM Microservices (REST/gRPC)
                    ├── NVIDIA Triton Inference Server (Dynamic Batching)
                    └── NVIDIA Nemotron Reasoning Engine (SLA Bottleneck Analysis)
                </pre>
            </div>
        </div>
    </section>

    <!-- 5. GOVERNANCE & ENTERPRISE READINESS -->
    <section id="governance" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="space-y-4">
                <span class="text-xs font-semibold uppercase tracking-widest text-indigo-400">Enterprise Readiness</span>
                <h2 class="text-3xl font-extrabold text-white">Uncompromising Governance & Audit Traceability</h2>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Designed from the ground up for strict regulatory standards. TaskVerge provides complete operational accountability so every decision, delegation, and status change is immutable.
                </p>

                <div class="space-y-3 pt-2">
                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-5 w-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs">✓</div>
                        <div>
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Mandatory Blocker Justifications</h4>
                            <p class="text-xs text-slate-400">Tasks cannot enter blocked states without captured root-cause documentation, alerting supervisors immediately.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-5 w-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs">✓</div>
                        <div>
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Role-Based Access Enforcement</h4>
                            <p class="text-xs text-slate-400">Granular role tiers ensure operators, managers, and administrators only modify authorized pipeline parameters.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-5 w-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs">✓</div>
                        <div>
                            <h4 class="text-xs font-bold text-white uppercase tracking-wider">Zero Blindspot Audit Trails</h4>
                            <p class="text-xs text-slate-400">Historical records of task movements, priority changes, reassignments, and notes remain permanent in SQL storage.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Certification Badges Card -->
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 sm:p-8 space-y-4">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider border-b border-slate-800 pb-3">Enterprise Compliance Standards</h3>
                
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/80">
                        <span class="text-xs font-bold text-indigo-400 font-mono">SOC2 Type II</span>
                        <p class="text-[11px] text-slate-400 mt-1">Security, confidentiality, and availability controls verified.</p>
                    </div>
                    <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/80">
                        <span class="text-xs font-bold text-emerald-400 font-mono">ISO 27001</span>
                        <p class="text-[11px] text-slate-400 mt-1">Information security management system certified.</p>
                    </div>
                    <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/80">
                        <span class="text-xs font-bold text-purple-400 font-mono">GDPR & CCPA</span>
                        <p class="text-[11px] text-slate-400 mt-1">Data sovereignty, erasure rights, and export compliance.</p>
                    </div>
                    <div class="p-3.5 rounded-xl border border-slate-800 bg-slate-900/80">
                        <span class="text-xs font-bold text-amber-400 font-mono">Air-Gapped Ready</span>
                        <p class="text-[11px] text-slate-400 mt-1">Isolated VPC and on-premises deployment capabilities.</p>
                    </div>
                </div>

                <div class="rounded-lg bg-indigo-950/30 border border-indigo-500/20 p-3 text-xs text-indigo-300">
                    All authentication mechanisms use secure password hashing, CSRF tokens, and parameter binding.
                </div>
            </div>
        </div>
    </section>

    <!-- 6. ENTERPRISE DEPLOYMENT & PRICING TIERS -->
    <section id="deployment" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-xs font-semibold uppercase tracking-widest text-indigo-400">Deployment Models</h2>
            <p class="text-3xl font-extrabold text-white mt-1">Flexible Enterprise Engagement Options</p>
            <p class="text-sm text-slate-400 mt-2">Scale from departmental operations to global multi-tenant deployments.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Tier 1 -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-6 space-y-4">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Team Department</span>
                    <h3 class="text-xl font-bold text-white mt-1">Operations Core</h3>
                    <p class="text-xs text-slate-400 mt-2">For dedicated operational divisions managing structured tasks and projects.</p>
                </div>
                <div class="text-2xl font-bold text-white">$49 <span class="text-xs text-slate-400 font-normal">/ user / mo</span></div>
                <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-slate-800">
                    <li>&check; Unlimited Workflows & Tasks</li>
                    <li>&check; Kanban & Table Interfaces</li>
                    <li>&check; Real-time Bottleneck Alerts</li>
                    <li>&check; Standard Activity Audit Trails</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'core']) }}" class="block text-center rounded-lg bg-slate-800 hover:bg-slate-700 py-2.5 text-xs font-semibold text-white transition-colors">
                    Configure Operations Core
                </a>
            </div>

            <!-- Tier 2 (Highlighted) -->
            <div class="rounded-xl border border-indigo-500/50 bg-gradient-to-b from-indigo-950/40 to-slate-950 p-6 space-y-4 relative shadow-xl">
                <div class="absolute -top-3 right-4 rounded-full bg-indigo-600 px-3 py-0.5 text-[10px] font-bold uppercase text-white tracking-wider">
                    Recommended
                </div>
                <div>
                    <span class="text-xs font-semibold text-indigo-400 uppercase tracking-wider">Enterprise Scale</span>
                    <h3 class="text-xl font-bold text-white mt-1">Workflow Intelligence</h3>
                    <p class="text-xs text-slate-400 mt-2">Full intelligence capabilities with NVIDIA accelerated bottleneck forecasting.</p>
                </div>
                <div class="text-2xl font-bold text-white">$119 <span class="text-xs text-slate-400 font-normal">/ user / mo</span></div>
                <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-indigo-900/60">
                    <li>&check; All Operations Core Features</li>
                    <li>&check; <strong>NVIDIA Triton & Nemotron Engine</strong></li>
                    <li>&check; Predictive Bottleneck Analysis</li>
                    <li>&check; Immutable SOC2 Audit Feeds</li>
                    <li>&check; Priority 24/7 Enterprise Support</li>
                </ul>
                <a href="{{ route('checkout', ['plan' => 'intelligence']) }}" class="block text-center rounded-lg bg-indigo-600 hover:bg-indigo-500 py-2.5 text-xs font-semibold text-white transition-colors shadow">
                    Launch Intelligence Subscription
                </a>
            </div>

            <!-- Tier 3 -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/70 p-6 space-y-4">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Dedicated Infra</span>
                    <h3 class="text-xl font-bold text-white mt-1">Air-Gapped Sovereign</h3>
                    <p class="text-xs text-slate-400 mt-2">Full on-premises deployment behind private VPCs or government air-gaps.</p>
                </div>
                <div class="text-2xl font-bold text-white">Custom <span class="text-xs text-slate-400 font-normal">deployment SLA</span></div>
                <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-slate-800">
                    <li>&check; Self-hosted Bare-Metal / VPC</li>
                    <li>&check; Dedicated Triton Inference Server</li>
                    <li>&check; Custom ERP/CRM Integration APIs</li>
                    <li>&check; Sovereign Data Residency Guarantee</li>
                </ul>
                <a href="{{ route('login') }}" class="block text-center rounded-lg bg-slate-800 hover:bg-slate-700 py-2.5 text-xs font-semibold text-white transition-colors">
                    Contact Architecture Team
                </a>
            </div>
        </div>
    </section>

    <!-- 7. FINAL CALL TO ACTION -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <div class="rounded-2xl border border-slate-800 bg-gradient-to-r from-indigo-950/40 via-purple-950/40 to-slate-950 p-8 sm:p-12 text-center space-y-6">
            <h2 class="text-3xl font-extrabold text-white">Transform Your Enterprise Workflow Velocity Today</h2>
            <p class="text-sm text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Take control of complex operations with structured pipelines, instant bottleneck visibility, and verified accountability.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('login') }}" class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white hover:bg-indigo-500 transition-colors shadow-lg shadow-indigo-600/30">
                    Sign In to Console
                </a>
                <a href="{{ route('register') }}" class="rounded-xl border border-slate-700 bg-slate-900 px-6 py-3 text-sm font-semibold text-slate-200 hover:bg-slate-800 hover:text-white transition-colors">
                    Register Enterprise Account
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

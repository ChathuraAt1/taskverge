@extends('layouts.guest')

@section('content')
<div class="space-y-32 sm:space-y-44 pb-36 overflow-hidden">

    <!-- 1. HERO SECTION: TaskVerge Cortex™ Introduction -->
    <section class="relative min-h-[80vh] flex flex-col justify-center px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto pt-12 pb-16">
        <!-- Ambient Radial Glows -->
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[700px] h-[450px] bg-emerald-500/15 rounded-full blur-[160px] pointer-events-none"></div>
        <div class="absolute top-1/2 right-4 w-[500px] h-[350px] bg-teal-500/10 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="relative z-10 max-w-5xl mx-auto text-center">
            <!-- Tech Badge -->
            <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-4 py-1.5 backdrop-blur-md mb-6 shadow-lg shadow-emerald-950/40">
                <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-bold text-emerald-300 uppercase tracking-wider">Enterprise Intelligence Engine &bull; Accelerated AI Stack</span>
            </div>

            <!-- Main Title -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.15]">
                TaskVerge <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Cortex™</span>
            </h1>

            <p class="mt-4 text-xl sm:text-2xl font-semibold text-slate-200 max-w-3xl mx-auto">
                Autonomous Workflow Intelligence & Neural Orchestration Engine
            </p>

            <p class="mt-5 text-sm sm:text-base text-slate-400 max-w-3xl mx-auto leading-relaxed">
                TaskVerge Cortex™ is an enterprise-grade workflow intelligence engine designed to eliminate operational coordination drag. It combines domain-trained reasoning models, real-time bottleneck forecasting, and autonomous unblocking actions to keep complex enterprise tasks moving forward without human handoff friction.
            </p>

            <!-- Funnel CTAs -->
            <div class="mt-9 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 px-8 py-4 text-sm font-bold text-white shadow-xl shadow-emerald-500/25 hover:from-emerald-400 hover:to-teal-500 transition-all scale-100 hover:scale-[1.02]">
                    <span>Launch Live Workspace</span>
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="#core-functions" class="inline-flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-900/80 px-6 py-4 text-sm font-semibold text-slate-300 hover:text-white hover:border-slate-700 transition-all">
                    <span>Explore Capabilities &darr;</span>
                </a>
            </div>

            <!-- AI Telemetry Live Badges Bar -->
            <div class="mt-14 pt-8 border-t border-slate-900 grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                <div class="rounded-xl border border-slate-800/80 bg-slate-900/50 p-3.5">
                    <div class="text-[11px] font-medium text-emerald-400 flex items-center justify-center gap-1.5">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                        Real-Time SLA Radar
                    </div>
                    <div class="text-sm font-bold text-white mt-1">48h Advance Prediction</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-900/50 p-3.5">
                    <div class="text-[11px] font-medium text-teal-300">Reasoning Core</div>
                    <div class="text-sm font-bold text-white mt-1">NVIDIA Nemotron-4</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-900/50 p-3.5">
                    <div class="text-[11px] font-medium text-cyan-300">Inference Serving</div>
                    <div class="text-sm font-bold text-white mt-1">TensorRT-LLM &bull; Triton</div>
                </div>
                <div class="rounded-xl border border-slate-800/80 bg-slate-900/50 p-3.5">
                    <div class="text-[11px] font-medium text-slate-400">Enterprise Privacy</div>
                    <div class="text-sm font-bold text-emerald-300 mt-1">Zero-Data-Leak VPC</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. CORE OPERATIONAL FUNCTIONS SHOWCASE -->
    <section id="core-functions" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto scroll-mt-24">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1 text-xs font-bold text-emerald-400 mb-3">
                Autonomous Capabilities
            </div>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                Intelligent Functions That Drive Velocity
            </h2>
            <p class="mt-4 text-sm sm:text-base text-slate-400 leading-relaxed">
                Rather than treating AI as a conversational gimmick, TaskVerge Cortex™ embeds intelligence directly into operational stage transitions, task scoring, and blocker remediation.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Function 1: Autonomous Triage -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-7 flex flex-col justify-between hover:border-emerald-500/40 transition-all group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="rounded-lg bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-1 text-xs font-bold text-emerald-400">
                            Function 01
                        </span>
                        <span class="text-[11px] font-mono text-slate-400">Confidence: 99.4%</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-emerald-300 transition-colors">Continuous Intake Triage</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-5">
                        Instantly digests incoming tickets, email requests, or system events. Extracts required skill profiles, evaluates team capacity, assigns priorities (Critical, High, Medium, Low), and routes items to the optimal stage.
                    </p>
                    <div class="rounded-xl border border-slate-800 bg-slate-950 p-3 text-[11px] font-mono text-slate-300 space-y-1">
                        <div class="text-emerald-400">&bull; Contextual Entity Extraction</div>
                        <div class="text-slate-400">&bull; Auto-Assigned: Lead Security Engineer</div>
                        <div class="text-slate-400">&bull; Stage: Initial Validation (Queue 02)</div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                    <span>Latency: &lt; 14ms</span>
                    <span class="text-emerald-400 font-semibold">Zero Human Touch</span>
                </div>
            </div>

            <!-- Function 2: Predictive SLA Radar -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-7 flex flex-col justify-between hover:border-teal-500/40 transition-all group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="rounded-lg bg-teal-500/10 border border-teal-500/20 px-2.5 py-1 text-xs font-bold text-teal-300">
                            Function 02
                        </span>
                        <span class="text-[11px] font-mono text-slate-400">Horizon: 48 Hours</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-teal-300 transition-colors">Cognitive Bottleneck Radar</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-5">
                        Monitors active stage dwell times, inter-task dependency trees, and operator velocities. Identifies hidden bottlenecks up to two days before an SLA breach occurs, alerting team leads before delays compound.
                    </p>
                    <div class="rounded-xl border border-slate-800 bg-slate-950 p-3 text-[11px] font-mono text-slate-300 space-y-1">
                        <div class="text-teal-300">&bull; Dependency Stall: 2 Precursor Tasks</div>
                        <div class="text-slate-400">&bull; Velocity Deficit: -3.2 hrs vs. Target</div>
                        <div class="text-amber-400">&bull; SLA Risk Triggered: 48h Advance</div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                    <span>Accuracy: 97.8%</span>
                    <span class="text-teal-300 font-semibold">Proactive Protection</span>
                </div>
            </div>

            <!-- Function 3: Self-Healing Unblocker -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-7 flex flex-col justify-between hover:border-cyan-500/40 transition-all group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="rounded-lg bg-cyan-500/10 border border-cyan-500/20 px-2.5 py-1 text-xs font-bold text-cyan-300">
                            Function 03
                        </span>
                        <span class="text-[11px] font-mono text-slate-400">Resolution: 1-Click</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-cyan-300 transition-colors">Self-Healing Unblock Actions</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-5">
                        When a task enters a blocked state, Cortex analyzes historical unblock pathways, recommends immediate remediation actions, and allows operators to resolve stalls with a single click while logging complete audit history.
                    </p>
                    <div class="rounded-xl border border-slate-800 bg-slate-950 p-3 text-[11px] font-mono text-slate-300 space-y-1">
                        <div class="text-cyan-300">&bull; Blocker Root: Vendor Contract Sign-Off</div>
                        <div class="text-slate-400">&bull; Recommended: Re-route to Legal Fastlane</div>
                        <div class="text-emerald-400">&bull; Operator Override: 1-Click Action</div>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                    <span>Recovery: Instant</span>
                    <span class="text-cyan-300 font-semibold">Operator Supervised</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. NVIDIA ENTERPRISE AI TECHNOLOGY SHOWCASE (REVAMPED FUNCTIONAL CARDS) -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1 text-xs font-bold text-emerald-400 mb-3">
                Accelerated Technology Foundations
            </div>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                NVIDIA Acceleration Stack
            </h2>
            <p class="mt-4 text-sm sm:text-base text-slate-400 leading-relaxed">
                TaskVerge Cortex™ is engineered upon the full NVIDIA enterprise AI stack, combining framework guardrails, cognitive reasoning models, and high-throughput inference microservices.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- 1. NVIDIA NeMo -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-8 relative overflow-hidden hover:border-emerald-500/40 transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3.5">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-bold text-lg">
                                NeMo
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">NVIDIA NeMo™</h3>
                                <p class="text-xs text-emerald-400 font-medium">Enterprise AI Workflow Development & Guardrails</p>
                            </div>
                        </div>
                        <span class="rounded bg-slate-800 px-2.5 py-1 font-mono text-xs text-slate-300">v2.1 SDK</span>
                    </div>

                    <p class="text-sm text-slate-300 leading-relaxed mb-6">
                        Supports the end-to-end development, domain fine-tuning, and operational guardrailing of Cortex's workflow automation models. NeMo enforces strict organizational guardrails, preventing ungrounded hallucination and guaranteeing that automated actions strictly adhere to corporate SOPs.
                    </p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Deterministic Guardrails:</strong> Guarantees that AI-generated stage transitions and task triage decisions comply with enterprise governance.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Domain-Specific Prompt Optimization:</strong> Calibrated specifically for enterprise operations, incident management, and agile sprints.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-800/80 bg-slate-950/80 p-4 flex items-center justify-between text-xs font-mono">
                    <span class="text-slate-400">Active Pipeline: <span class="text-emerald-400">NeMo Operational Guardrail 2.4</span></span>
                    <span class="text-slate-500">Zero Hallucinations</span>
                </div>
            </div>

            <!-- 2. NVIDIA Nemotron -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-8 relative overflow-hidden hover:border-teal-500/40 transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3.5">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-500/10 border border-teal-500/30 text-teal-400 font-bold text-lg">
                                NTR
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">NVIDIA Nemotron™</h3>
                                <p class="text-xs text-teal-400 font-medium">Enterprise Reasoning & Language Models</p>
                            </div>
                        </div>
                        <span class="rounded bg-slate-800 px-2.5 py-1 font-mono text-xs text-slate-300">Nemotron-4 340B</span>
                    </div>

                    <p class="text-sm text-slate-300 leading-relaxed mb-6">
                        Provides high-parameter reasoning capabilities tailored for complex business logic. Nemotron evaluates multi-stage dependencies across disparate projects, calculates critical execution paths, and forecasts operational stall points before human operators notice friction.
                    </p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-teal-500/20 text-teal-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Dependency Graph Reasoning:</strong> Understands predecessor and successor constraints across 100+ concurrent workflows.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-teal-500/20 text-teal-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Contextual Root-Cause Analysis:</strong> Pinpoints the specific team, resource, or external vendor creating delay risk.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-800/80 bg-slate-950/80 p-4 flex items-center justify-between text-xs font-mono">
                    <span class="text-slate-400">Reasoning Depth: <span class="text-teal-300">Multi-Hop Graph Analysis</span></span>
                    <span class="text-slate-500">99.2% Logic Fidelity</span>
                </div>
            </div>

            <!-- 3. NVIDIA NIM -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-8 relative overflow-hidden hover:border-cyan-500/40 transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3.5">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 font-bold text-lg">
                                NIM
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">NVIDIA NIM™</h3>
                                <p class="text-xs text-cyan-400 font-medium">Production Inference Microservices</p>
                            </div>
                        </div>
                        <span class="rounded bg-slate-800 px-2.5 py-1 font-mono text-xs text-slate-300">Containerized</span>
                    </div>

                    <p class="text-sm text-slate-300 leading-relaxed mb-6">
                        Packages foundation and domain models into standardized, containerized microservices. NIM enables Cortex to run self-hosted inside enterprise Virtual Private Clouds (VPCs) or air-gapped data centers, guaranteeing total data sovereignty and zero telemetry leak.
                    </p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-cyan-500/20 text-cyan-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Zero-Data-Leak Deployment:</strong> Proprietary enterprise workflows and tasks never touch third-party external APIs.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-cyan-500/20 text-cyan-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Microservice Portability:</strong> Deployable on Kubernetes, AWS EKS, Azure AKS, or on-premise DGX systems.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-800/80 bg-slate-950/80 p-4 flex items-center justify-between text-xs font-mono">
                    <span class="text-slate-400">Environment: <span class="text-cyan-300">Self-Hosted Kubernetes</span></span>
                    <span class="text-slate-500">SOC2 & HIPAA Ready</span>
                </div>
            </div>

            <!-- 4. NVIDIA Triton -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-8 relative overflow-hidden hover:border-emerald-500/40 transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3.5">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-bold text-lg">
                                TRT
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">NVIDIA Triton™</h3>
                                <p class="text-xs text-emerald-400 font-medium">Inference Server & Dynamic Batching</p>
                            </div>
                        </div>
                        <span class="rounded bg-slate-800 px-2.5 py-1 font-mono text-xs text-slate-300">High-Throughput</span>
                    </div>

                    <p class="text-sm text-slate-300 leading-relaxed mb-6">
                        Orchestrates high-concurrency model execution with dynamic request batching. Triton maximizes GPU utilization across Tensor Core clusters, ensuring that simultaneous task intake bursts and real-time dashboard updates are resolved with sub-15ms response latencies.
                    </p>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Dynamic Batching Engine:</strong> Groups multi-user intake events in real time to optimize computational density.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 text-xs text-slate-300">
                            <span class="h-5 w-5 rounded-md bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0 font-bold">&check;</span>
                            <div>
                                <strong class="text-white">Multi-Model Pipeline Execution:</strong> Runs classification, reasoning, and vector generation concurrently on single GPU instances.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-slate-800/80 bg-slate-950/80 p-4 flex items-center justify-between text-xs font-mono">
                    <span class="text-slate-400">Serving Latency: <span class="text-emerald-400">&lt; 12ms Average</span></span>
                    <span class="text-slate-500">10,000+ Req/Sec</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. EXPANDED ENTERPRISE AI TRAINING & INFERENCE TOOLSET -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 rounded-full border border-teal-500/30 bg-teal-500/10 px-3.5 py-1 text-xs font-bold text-teal-400 mb-3">
                Full-Lifecycle AI Tooling
            </div>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                Enterprise AI Training & Serving Stack
            </h2>
            <p class="mt-4 text-sm sm:text-base text-slate-400 leading-relaxed">
                TaskVerge Cortex™ integrates modern open-source and proprietary enterprise frameworks for continuous fine-tuning, distributed GPU orchestration, and persistent organizational memory.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Tool 1: TensorRT-LLM -->
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 flex flex-col justify-between hover:border-slate-700 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-mono font-bold text-emerald-400 uppercase tracking-wider">Compiler</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">FP8 / FP16</span>
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">NVIDIA TensorRT-LLM</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Kernel-level optimization library providing in-flight batching, paged attention, and customized GPU execution graphs. Delivers up to 8x faster inference throughput.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-800/80 text-[11px] text-emerald-400 font-medium">
                    &bull; Sub-10ms Token Latency
                </div>
            </div>

            <!-- Tool 2: LoRA / QLoRA Fine-Tuning -->
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 flex flex-col justify-between hover:border-slate-700 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-mono font-bold text-teal-400 uppercase tracking-wider">Training</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">PEFT</span>
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">LoRA & QLoRA Tuning</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Parameter-efficient fine-tuning pipelines allowing Cortex to adapt to proprietary company jargon, departmental taxonomy, and internal runbooks without catastrophic forgetting.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-800/80 text-[11px] text-teal-400 font-medium">
                    &bull; Continuous SOP Learning
                </div>
            </div>

            <!-- Tool 3: vLLM & Ray Distributed Serving -->
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 flex flex-col justify-between hover:border-slate-700 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-mono font-bold text-cyan-400 uppercase tracking-wider">Clustering</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">Ray Engine</span>
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">vLLM & Ray Serving</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Distributed orchestration engine managing KV-cache memory efficiently across multi-node GPU clusters. Dynamically scales during morning task surges and quarterly reviews.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-800/80 text-[11px] text-cyan-400 font-medium">
                    &bull; PagedAttention Memory
                </div>
            </div>

            <!-- Tool 4: Vector RAG Knowledge Fabric -->
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6 flex flex-col justify-between hover:border-slate-700 transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-mono font-bold text-emerald-400 uppercase tracking-wider">Memory</span>
                        <span class="rounded bg-slate-800 px-2 py-0.5 text-[10px] font-mono text-slate-300">Vector Embeddings</span>
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">Vector RAG Fabric</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Dense embedding index storing historical unblock playbooks, operational post-mortems, and regulatory policies. Provides instant semantic grounding for all automated triage actions.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-slate-800/80 text-[11px] text-emerald-400 font-medium">
                    &bull; Sub-Millisecond Retrieval
                </div>
            </div>
        </div>
    </section>

    <!-- 5. INTERACTIVE NEURAL ORCHESTRATION PIPELINE EXPLORER -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="rounded-3xl border border-slate-800 bg-slate-900/60 p-8 sm:p-10 shadow-2xl" x-data="{
            activeStep: 1,
            steps: [
                { id: 1, title: '01. Multi-Vector Ingestion', tool: 'Intake Engine', summary: 'Intake payload captured via Webhooks, REST, or User Input.' },
                { id: 2, title: '02. NeMo Guardrails', tool: 'NVIDIA NeMo', summary: 'Context parsing, entity extraction, and priority classification.' },
                { id: 3, title: '03. Nemotron Reasoning', tool: 'NVIDIA Nemotron', summary: 'Dependency mapping, bottleneck prediction, and SLA risk scoring.' },
                { id: 4, title: '04. TensorRT Serving', tool: 'Triton & TensorRT', summary: 'Dynamic batching and GPU-accelerated microservice execution.' },
                { id: 5, title: '05. Vector Memory Sync', tool: 'Vector RAG Fabric', summary: 'Semantic resolution lookup and historical precedent retrieval.' },
                { id: 6, title: '06. Autonomous Action', tool: 'Cortex Sentry', summary: 'State transition applied with 1-click operator verification.' }
            ]
        }">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 pb-6 border-b border-slate-800">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Interactive Runtime</span>
                    <h3 class="text-2xl font-bold text-white mt-1">Autonomous Execution Lifecycle</h3>
                </div>
                <div class="text-xs text-slate-400">
                    Click any phase to inspect live telemetry and model payloads
                </div>
            </div>

            <!-- Steps Tabs -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2.5 mb-8">
                <template x-for="step in steps" :key="step.id">
                    <button 
                        @click="activeStep = step.id"
                        :class="activeStep === step.id 
                            ? 'border-emerald-500 bg-emerald-500/15 text-white shadow-md shadow-emerald-500/10' 
                            : 'border-slate-800 bg-slate-950/60 text-slate-400 hover:border-slate-700 hover:text-slate-200'"
                        class="rounded-xl border p-3 text-left transition-all"
                    >
                        <div class="text-[10px] font-mono" :class="activeStep === step.id ? 'text-emerald-300' : 'text-slate-500'" x-text="step.tool"></div>
                        <div class="text-xs font-bold mt-1 truncate" x-text="step.title"></div>
                    </button>
                </template>
            </div>

            <!-- Interactive Stage Detail Cards -->
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 sm:p-8">
                <!-- Step 1 -->
                <div x-show="activeStep === 1" x-cloak class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-bold text-white">Stage 01: Multi-Vector Task Ingestion</h4>
                        <span class="rounded bg-slate-800 px-2.5 py-1 text-xs font-mono text-emerald-400">Intake Engine</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        A task request enters TaskVerge Cortex™ via user creation, enterprise ticketing webhooks, or automated monitoring alerts. The payload is sanitized, normalized, and timestamped for processing.
                    </p>
                    <div class="bg-slate-900 rounded-xl p-4 font-mono text-xs text-slate-300">
                        { "title": "SOC2 Type II Audit Preparation", "priority": "high", "workflow": "Security & Governance" }
                    </div>
                </div>

                <!-- Step 2 -->
                <div x-show="activeStep === 2" x-cloak class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-bold text-white">Stage 02: NeMo Context & Operational Guardrails</h4>
                        <span class="rounded bg-slate-800 px-2.5 py-1 text-xs font-mono text-emerald-400">NVIDIA NeMo Framework</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        NeMo applies domain-specific prompts and deterministic guardrails to classify task urgency, extract technical dependencies, and match the task with optimal team member skill sets while preventing unverified AI hallucinations.
                    </p>
                    <div class="bg-slate-900 rounded-xl p-4 font-mono text-xs text-emerald-300">
                        NeMo Guardrail Status: APPROVED &bull; Extracted Entities: [Deadline: 2026-09-24, Assignee_Skill: "InfoSec", Priority_Tier: "Critical"]
                    </div>
                </div>

                <!-- Step 3 -->
                <div x-show="activeStep === 3" x-cloak class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-bold text-white">Stage 03: Nemotron Reasoning & Bottleneck Prediction</h4>
                        <span class="rounded bg-slate-800 px-2.5 py-1 text-xs font-mono text-teal-400">NVIDIA Nemotron-4 340B</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Nemotron evaluates the workflow's dependency graph. It compares historical velocity against current team capacity and flags potential bottlenecks 48 hours before an SLA violation occurs.
                    </p>
                    <div class="bg-slate-900 rounded-xl p-4 font-mono text-xs text-teal-300">
                        SLA Radar Forecast: 99.4% On-Track &bull; Stage Risk: Low &bull; Unblock Pathway: Auto-Routed to Primary Operator
                    </div>
                </div>

                <!-- Step 4 -->
                <div x-show="activeStep === 4" x-cloak class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-bold text-white">Stage 04: Triton & TensorRT High-Speed Serving</h4>
                        <span class="rounded bg-slate-800 px-2.5 py-1 text-xs font-mono text-cyan-400">Triton / TensorRT-LLM</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Triton Inference Server handles concurrent requests with dynamic batching, executing on NVIDIA Tensor Core GPUs in milliseconds. Standardized NIM containers guarantee enterprise data isolation and zero external telemetry leak.
                    </p>
                    <div class="bg-slate-900 rounded-xl p-4 font-mono text-xs text-cyan-300">
                        Inference Latency: 8.4ms &bull; GPU Utilization: 42% &bull; Dynamic Batch Size: 16 &bull; Precision: FP16 TensorRT
                    </div>
                </div>

                <!-- Step 5 -->
                <div x-show="activeStep === 5" x-cloak class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-bold text-white">Stage 05: Vector RAG Knowledge Fabric Sync</h4>
                        <span class="rounded bg-slate-800 px-2.5 py-1 text-xs font-mono text-emerald-400">Vector Knowledge Fabric</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        Cortex queries the dense vector memory index to match the current task with company policies, past resolution paths, and operational playbooks, enriching the task card with verified remediation tips.
                    </p>
                    <div class="bg-slate-900 rounded-xl p-4 font-mono text-xs text-slate-300">
                        Vector Match: "SOP-14: SOC2 Compliance Sign-Off Playbook" &bull; Similarity: 0.94 &bull; Injected Resolution Checklist
                    </div>
                </div>

                <!-- Step 6 -->
                <div x-show="activeStep === 6" x-cloak class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-bold text-white">Stage 06: Autonomous Action & Operator Supervision</h4>
                        <span class="rounded bg-slate-800 px-2.5 py-1 text-xs font-mono text-emerald-400">Cortex Autonomous Sentry</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        The task advances to the appropriate stage with auto-assigned ownership, live SLA countdown, and automated escalation triggers. Human operators retain final override authority with 1-click unblock actions.
                    </p>
                    <div class="bg-slate-900 rounded-xl p-4 font-mono text-xs text-emerald-300">
                        Task State: ACTIVE &bull; Stage: Security Review &bull; SLA Horizon: 72h &bull; Audit Trail: Chronologically Immutable
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. FINAL CONVERSION BANNER: Product to Dashboard Flow -->
    <section class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="relative rounded-3xl border border-emerald-500/40 bg-gradient-to-tr from-slate-950 via-slate-900 to-emerald-950/40 p-10 sm:p-16 overflow-hidden text-center shadow-2xl">
            <!-- Background Halo -->
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[550px] h-[350px] bg-emerald-500/20 rounded-full blur-[140px] pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1 text-xs font-bold text-emerald-400 mb-4">
                    Ready for Operational Excellence
                </div>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                    Experience TaskVerge Cortex™ in Action
                </h2>
                <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-2xl mx-auto">
                    Transform scattered tickets into an autonomous, proactive operational workspace. Empower your team with predictive SLA radar and zero-friction execution.
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-8 py-4 text-sm font-bold text-white shadow-xl shadow-emerald-600/30 transition-all scale-100 hover:scale-[1.02]">
                        <span>Enter Application Dashboard</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-900 px-6 py-4 text-sm font-semibold text-slate-300 hover:text-white transition-all">
                        <span>Contact Enterprise Sales</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

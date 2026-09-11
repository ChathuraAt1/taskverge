<div class="h-[calc(100vh-7rem)] flex flex-col space-y-4">
    <!-- Top Header & Quota Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-800">
        <div>
            <div class="flex items-center gap-2.5">
                <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/20">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-extrabold text-white tracking-tight flex items-center gap-2">
                        TaskVerge Cortex Copilot™
                        <span class="rounded-full bg-emerald-500/10 border border-emerald-500/30 px-2 py-0.5 text-[10px] font-bold text-emerald-400 uppercase tracking-wider">AI Live</span>
                    </h2>
                    <p class="text-xs text-slate-400">Conversational workflow intelligence, bottleneck unblocking & task synthesis</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <!-- Usage & Plan Limit Badge -->
            <div class="flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-950 px-3 py-1.5 text-xs">
                <span class="text-slate-400">Plan: <strong class="text-white">{{ $planConfig['label'] ?? 'Free Trial' }}</strong></span>
                <span class="text-slate-700">•</span>
                <span class="text-slate-400">
                    Queries: 
                    @if($limit === null)
                        <span class="text-emerald-400 font-bold">Unlimited</span>
                    @else
                        <span class="text-white font-semibold">{{ $queriesUsedThisMonth }} / {{ $limit }}</span>
                    @endif
                </span>
                @if($limit !== null && $queriesUsedThisMonth >= $limit * 0.8)
                    <a href="{{ route('checkout') }}?plan=core" class="ml-1 text-[11px] font-bold text-amber-400 hover:text-amber-300 underline">Upgrade</a>
                @endif
            </div>

            <button wire:click="clearConversation" class="rounded-xl border border-slate-800 bg-slate-900 hover:bg-slate-800 px-3 py-1.5 text-xs font-semibold text-slate-300 hover:text-white transition-colors">
                Reset Chat
            </button>
        </div>
    </div>

    @if (session('copilot_limit'))
        <div class="rounded-xl border border-amber-500/30 bg-amber-500/10 p-3 text-xs text-amber-300 flex items-center justify-between">
            <span>⚠️ {{ session('copilot_limit') }}</span>
            <a href="{{ route('checkout') }}?plan=core" class="font-bold underline ml-2">Upgrade Now</a>
        </div>
    @endif

    <!-- Preset Action Chips -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
        <span class="text-slate-500 font-medium whitespace-nowrap text-[11px] uppercase tracking-wider">Quick Prompts:</span>
        <button wire:click="sendPreset('What tasks are currently blocked across our pipelines?')" 
                class="rounded-full border border-slate-800 bg-slate-950/80 hover:border-emerald-500/50 hover:bg-slate-900 px-3 py-1 text-slate-300 hover:text-white whitespace-nowrap transition-all flex items-center gap-1.5">
            <span>⚠️</span> What tasks are blocked?
        </button>
        <button wire:click="sendPreset('Which deadlines are at SLA risk in the next 48 hours?')" 
                class="rounded-full border border-slate-800 bg-slate-950/80 hover:border-emerald-500/50 hover:bg-slate-900 px-3 py-1 text-slate-300 hover:text-white whitespace-nowrap transition-all flex items-center gap-1.5">
            <span>⏱️</span> Analyze SLA risks
        </button>
        <button wire:click="sendPreset('Draft a task to optimize GPU inference batching in Triton')" 
                class="rounded-full border border-slate-800 bg-slate-950/80 hover:border-emerald-500/50 hover:bg-slate-900 px-3 py-1 text-slate-300 hover:text-white whitespace-nowrap transition-all flex items-center gap-1.5">
            <span>📋</span> Draft Triton task
        </button>
        <button wire:click="sendPreset('Give me a high-level summary of our team workflow status')" 
                class="rounded-full border border-slate-800 bg-slate-950/80 hover:border-emerald-500/50 hover:bg-slate-900 px-3 py-1 text-slate-300 hover:text-white whitespace-nowrap transition-all flex items-center gap-1.5">
            <span>📊</span> Status summary
        </button>
    </div>

    <!-- Chat Message History Container -->
    <div class="flex-1 overflow-y-auto rounded-2xl border border-slate-800 bg-slate-950/60 p-4 sm:p-6 space-y-4 shadow-inner">
        @foreach($conversation as $msg)
            @if($msg['role'] === 'user')
                <!-- User Message -->
                <div class="flex justify-end gap-3">
                    <div class="max-w-2xl rounded-2xl rounded-tr-none bg-emerald-600 p-4 text-xs sm:text-sm text-white shadow-md">
                        <div class="font-medium whitespace-pre-wrap">{{ $msg['content'] }}</div>
                        <div class="mt-1 text-[10px] text-emerald-200/80 text-right">{{ $msg['time'] ?? '' }}</div>
                    </div>
                    <img class="h-8 w-8 rounded-xl object-cover ring-1 ring-slate-700 flex-shrink-0" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                </div>
            @else
                <!-- Assistant / Copilot Message -->
                <div class="flex gap-3">
                    <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center text-white text-xs font-bold shadow-md shadow-emerald-500/20 flex-shrink-0">
                        AI
                    </div>
                    <div class="max-w-2xl space-y-2">
                        <div class="rounded-2xl rounded-tl-none border border-slate-800 bg-slate-900 p-4 text-xs sm:text-sm text-slate-200 shadow-md space-y-2 leading-relaxed">
                            <div class="prose prose-invert prose-xs max-w-none">
                                {!! nl2br(e($msg['content'])) !!}
                            </div>

                            @if(!empty($msg['draft']))
                                <!-- Actionable Task Proposal Card -->
                                <div class="mt-3 rounded-xl border border-emerald-500/40 bg-emerald-950/30 p-3.5 space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-400">Structured Task Proposal</span>
                                        <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[10px] font-bold uppercase text-emerald-300">{{ $msg['draft']['priority'] ?? 'High' }}</span>
                                    </div>
                                    <div class="font-bold text-white text-xs">{{ $msg['draft']['title'] }}</div>
                                    <div class="text-[11px] text-slate-300">Effort estimate: <strong>{{ $msg['draft']['estimated_hours'] ?? 4 }} hours</strong></div>
                                    
                                    <button wire:click="deployDraftTask" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/30 transition-all">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Deploy Task to Pipeline
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 px-1 text-[10px] text-slate-500">
                            <span>{{ $msg['source'] ?? 'Cortex Copilot' }}</span>
                            <span>•</span>
                            <span>{{ $msg['time'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Loading State -->
        <div wire:loading wire:target="sendMessage, sendPreset" class="flex gap-3">
            <div class="h-8 w-8 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center text-white text-xs font-bold animate-pulse">
                AI
            </div>
            <div class="rounded-2xl rounded-tl-none border border-slate-800 bg-slate-900 p-4 text-xs text-slate-400 flex items-center gap-2">
                <svg class="animate-spin h-4 w-4 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Cortex AI is analyzing workflow graphs and synthesizing response...</span>
            </div>
        </div>
    </div>

    <!-- Message Input Bar -->
    <form wire:submit="sendMessage" class="relative">
        <div class="flex items-center gap-2 rounded-2xl border border-slate-800 bg-slate-950 p-2 shadow-xl focus-within:border-emerald-500 transition-colors">
            <input 
                type="text" 
                wire:model="inputPrompt" 
                placeholder="Ask Cortex Copilot about blockers, SLA risks, capacity, or say 'Draft a task for...'..." 
                class="flex-1 bg-transparent px-3 py-2 text-xs sm:text-sm text-white placeholder-slate-500 focus:outline-none"
            >
            <button 
                type="submit" 
                class="inline-flex items-center gap-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-600/30 transition-all disabled:opacity-50"
                wire:loading.attr="disabled"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                <span class="hidden sm:inline">Send</span>
            </button>
        </div>
    </form>
</div>

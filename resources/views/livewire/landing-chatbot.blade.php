<div class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
    <!-- Chat Modal Window -->
    <div 
        x-cloak
        x-show="$wire.isOpen"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-6 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-6 scale-95"
        class="mb-4 w-[92vw] sm:w-[410px] h-[560px] max-h-[82vh] rounded-3xl border border-slate-800 bg-slate-950/95 backdrop-blur-xl shadow-2xl flex flex-col overflow-hidden ring-1 ring-emerald-500/20"
    >
        <!-- Top Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-800/80 bg-slate-900/60">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="h-10 w-10 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 flex items-center justify-center text-white shadow-lg shadow-emerald-500/20">
                        <img src="{{ asset('images/favicon.ico') }}" alt="TaskVerge Logo" class="h-6 w-auto">
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full bg-emerald-400 border-2 border-slate-950 animate-pulse"></span>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <h3 class="text-sm font-bold text-white leading-none">TaskVerge Cortex™</h3>
                        <span class="rounded-full bg-emerald-500/10 border border-emerald-500/30 px-2 py-0.5 text-[9px] font-bold text-emerald-400 uppercase tracking-wider">
                            {{ $hasApiKey ? 'AI Live' : 'AI Engine' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-1">
                <button 
                    wire:click="clearChat" 
                    title="Reset conversation"
                    class="p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800 transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </button>
                <button 
                    wire:click="closeChat" 
                    title="Close chat"
                    class="p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800 transition-colors"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Preset Quick Chips -->
        <div class="px-4 py-2 bg-slate-900/40 border-b border-slate-800/60 flex items-center gap-1.5 overflow-x-auto no-scrollbar text-[11px]">
            <span class="text-slate-500 font-semibold uppercase tracking-wider text-[10px] shrink-0">Ask:</span>
            <button wire:click="sendPreset('What is TaskVerge and how does it work?')" class="rounded-full border border-slate-800 bg-slate-900/80 hover:border-emerald-500/40 hover:bg-slate-800 text-slate-300 hover:text-white px-2.5 py-1 whitespace-nowrap transition-colors shrink-0">
                What is TaskVerge?
            </button>
            <button wire:click="sendPreset('What are your pricing plans?')" class="rounded-full border border-slate-800 bg-slate-900/80 hover:border-emerald-500/40 hover:bg-slate-800 text-slate-300 hover:text-white px-2.5 py-1 whitespace-nowrap transition-colors shrink-0">
                Pricing Plans
            </button>
            <button wire:click="sendPreset('Where are your offices and how can I contact support?')" class="rounded-full border border-slate-800 bg-slate-900/80 hover:border-emerald-500/40 hover:bg-slate-800 text-slate-300 hover:text-white px-2.5 py-1 whitespace-nowrap transition-colors shrink-0">
                Offices & Contact
            </button>
            <button wire:click="sendPreset('How do I start a free trial?')" class="rounded-full border border-slate-800 bg-slate-900/80 hover:border-emerald-500/40 hover:bg-slate-800 text-slate-300 hover:text-white px-2.5 py-1 whitespace-nowrap transition-colors shrink-0">
                Free Trial
            </button>
        </div>

        <!-- Chat Messages Thread -->
        <div 
            id="landing-chat-messages" 
            x-data="{
                scrollToBottom() {
                    this.$nextTick(() => {
                        this.$el.scrollTo({ top: this.$el.scrollHeight, behavior: 'smooth' });
                    });
                }
            }"
            x-init="
                scrollToBottom();
                $watch('$wire.messages', () => scrollToBottom());
                $watch('$wire.isTyping', () => scrollToBottom());
            "
            @chat-updated.window="scrollToBottom()"
            class="flex-1 overflow-y-auto p-4 space-y-4 text-xs leading-relaxed"
        >
            @foreach($messages as $msg)
                @if($msg['role'] === 'user')
                    <!-- User Message -->
                    <div class="flex justify-end">
                        <div class="max-w-[85%] rounded-2xl rounded-tr-sm bg-gradient-to-r from-emerald-600 to-teal-600 px-4 py-3 text-white shadow-md shadow-emerald-900/20">
                            <p class="whitespace-pre-wrap">{{ $msg['content'] }}</p>
                            <span class="block text-[10px] text-emerald-200/70 text-right mt-1 font-mono">{{ $msg['time'] }}</span>
                        </div>
                    </div>
                @else
                    <!-- Assistant Message -->
                    <div class="flex items-start gap-2.5">
                        <div class="h-7 w-7 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-emerald-400 shrink-0 mt-0.5">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                            </svg>
                        </div>
                        <div class="max-w-[88%] rounded-2xl rounded-tl-sm border border-slate-800 bg-slate-900/80 px-4 py-3 text-slate-200 shadow-md space-y-2">
                            <div class="prose prose-invert prose-emerald max-w-none text-xs leading-relaxed">
                                {!! Str::markdown($msg['content']) !!}
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-slate-500 pt-1 border-t border-slate-800/50 font-mono">
                                <span>{{ 'TaskVerge AI' }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Typing Indicator -->
            @if($isTyping)
                <div class="flex items-start gap-2.5">
                    <div class="h-7 w-7 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-emerald-400 shrink-0 mt-0.5">
                        <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div class="rounded-2xl rounded-tl-sm border border-slate-800 bg-slate-900/80 px-4 py-3 text-slate-400 flex items-center gap-1.5">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-bounce"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-bounce [animation-delay:0.2s]"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-bounce [animation-delay:0.4s]"></span>
                        <span class="text-[11px] font-mono text-slate-400 ml-1.5">Thinking...</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Input Area -->
        <form wire:submit.prevent="sendMessage" class="p-3 border-t border-slate-800/80 bg-slate-900/70">
            <div class="flex items-center gap-2">
                <input 
                    type="text" 
                    wire:model="inputMessage" 
                    placeholder="Ask about features, plans, SLA..." 
                    class="flex-1 rounded-xl border border-slate-800 bg-slate-950 px-3.5 py-2.5 text-xs text-white placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500 transition-colors"
                />
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="h-9 w-9 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 flex items-center justify-center text-white shadow-md shadow-emerald-500/25 transition-all shrink-0 disabled:opacity-50"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </button>
            </div>
            <div class="mt-2 flex items-center justify-between text-[10px] text-slate-500 px-1">
                <span>TaskVerge Cortex™ Intelligence</span>
                <a href="{{ route('home') }}#contact" class="text-emerald-400 hover:underline">Need a human?</a>
            </div>
        </form>
    </div>

    <!-- Floating Launcher Button -->
    <button 
        wire:click="toggleChat" 
        type="button" 
        class="group flex items-center gap-3 rounded-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 p-1 pr-4 shadow-2xl shadow-emerald-500/30 hover:scale-105 active:scale-95 transition-all text-white border border-emerald-400/30"
        aria-label="Open AI Assistant"
    >
        <div class="h-11 w-11 rounded-full bg-slate-950/40 flex items-center justify-center backdrop-blur-sm relative">
            <img x-show="!$wire.isOpen" src="{{ asset('images/favicon.ico') }}" alt="TaskVerge Logo" class="h-6 w-auto transition-transform group-hover:rotate-12">
            <svg x-cloak x-show="$wire.isOpen" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="absolute top-0 right-0 h-3 w-3 rounded-full bg-emerald-300 border-2 border-slate-950 animate-ping"></span>
        </div>
        <div class="text-left">
            <div class="text-xs font-black tracking-wide leading-tight">Ask AI</div>
            <div class="text-[10px] text-emerald-100/80 font-medium">TaskVerge Copilot</div>
        </div>
    </button>
</div>

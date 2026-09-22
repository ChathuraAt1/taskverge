<div 
    x-data="{
        showBanner: false,
        showPreferences: false,
        analytics: true,
        marketing: false,
        init() {
            const consent = localStorage.getItem('taskverge_cookie_consent');
            if (!consent) {
                // Give user a brief moment after page load
                setTimeout(() => {
                    this.showBanner = true;
                }, 800);
            } else {
                try {
                    const parsed = JSON.parse(consent);
                    this.analytics = parsed.analytics ?? true;
                    this.marketing = parsed.marketing ?? false;
                } catch (e) {}
            }
        },
        acceptAll() {
            const consent = {
                essential: true,
                analytics: true,
                marketing: true,
                accepted_at: new Date().toISOString()
            };
            localStorage.setItem('taskverge_cookie_consent', JSON.stringify(consent));
            this.showBanner = false;
            this.showPreferences = false;
        },
        rejectNonEssential() {
            const consent = {
                essential: true,
                analytics: false,
                marketing: false,
                accepted_at: new Date().toISOString()
            };
            localStorage.setItem('taskverge_cookie_consent', JSON.stringify(consent));
            this.showBanner = false;
            this.showPreferences = false;
        },
        savePreferences() {
            const consent = {
                essential: true,
                analytics: this.analytics,
                marketing: this.marketing,
                accepted_at: new Date().toISOString()
            };
            localStorage.setItem('taskverge_cookie_consent', JSON.stringify(consent));
            this.showBanner = false;
            this.showPreferences = false;
        }
    }"
>
    <!-- Cookie Banner Bar / Card -->
    <div 
        x-cloak
        x-show="showBanner && !showPreferences"
        x-transition:enter="transition ease-out duration-400 transform"
        x-transition:enter-start="opacity-0 translate-y-10 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-10 scale-95"
        class="fixed bottom-6 left-6 z-50 max-w-lg w-[calc(100vw-3rem)] sm:w-auto rounded-3xl border border-slate-800 bg-slate-950/95 backdrop-blur-xl p-5 sm:p-6 shadow-2xl ring-1 ring-emerald-500/20"
        role="dialog"
        aria-modal="true"
        aria-labelledby="cookie-consent-title"
    >
        <div class="flex items-start gap-4">
            <div class="h-10 w-10 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shrink-0">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <div class="flex-1 space-y-2">
                <h3 id="cookie-consent-title" class="text-sm sm:text-base font-bold text-white flex items-center gap-2">
                    <span>Cookie &amp; Privacy Choices</span>
                </h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                    We use cookies and telemetry technologies to enhance site navigation, deliver secure workflow sessions, and analyze site performance. Read our 
                    <a href="{{ route('privacy') }}" class="text-emerald-400 hover:text-emerald-300 underline underline-offset-2">Privacy Policy</a> and 
                    <a href="{{ route('terms') }}" class="text-emerald-400 hover:text-emerald-300 underline underline-offset-2">Terms</a>.
                </p>
            </div>
        </div>

        <div class="mt-5 pt-4 border-t border-slate-800/80 flex flex-wrap items-center justify-between gap-2.5">
            <button 
                @click="showPreferences = true" 
                type="button" 
                class="text-xs font-semibold text-slate-400 hover:text-slate-200 transition-colors px-2 py-1.5 underline underline-offset-4"
            >
                Customize
            </button>
            <div class="flex items-center gap-2">
                <button 
                    @click="rejectNonEssential()" 
                    type="button" 
                    class="rounded-xl border border-slate-800 bg-slate-900 px-3.5 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-800 hover:text-white transition-colors"
                >
                    Reject Non-Essential
                </button>
                <button 
                    @click="acceptAll()" 
                    type="button" 
                    class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 px-4 py-2 text-xs font-bold text-white shadow-lg shadow-emerald-500/20 hover:from-emerald-400 hover:to-teal-500 transition-all"
                >
                    Accept All
                </button>
            </div>
        </div>
    </div>

    <!-- Cookie Preferences Modal -->
    <div 
        x-cloak
        x-show="showPreferences"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md"
        role="dialog"
        aria-modal="true"
    >
        <div 
            @click.outside="showPreferences = false"
            class="w-full max-w-md rounded-3xl border border-slate-800 bg-slate-950 p-6 sm:p-7 shadow-2xl space-y-5"
        >
            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                <div class="flex items-center gap-2.5">
                    <div class="h-8 w-8 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-white">Privacy Preferences</h4>
                        <p class="text-xs text-slate-400">Manage how cookies are used</p>
                    </div>
                </div>
                <button @click="showPreferences = false" class="text-slate-400 hover:text-white p-1 rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Categories -->
            <div class="space-y-3.5 text-xs">
                <!-- Essential -->
                <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-3.5 flex items-start justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-white">Strictly Necessary</span>
                            <span class="text-[10px] font-mono rounded bg-slate-800 px-1.5 py-0.5 text-emerald-400">Always Active</span>
                        </div>
                        <p class="text-slate-400 mt-1 text-[11px] leading-relaxed">
                            Required for fundamental website security, CSRF protection, and session authentication. Cannot be switched off.
                        </p>
                    </div>
                    <input type="checkbox" checked disabled class="h-4 w-4 rounded border-slate-700 text-emerald-500 focus:ring-0 opacity-70 mt-1 cursor-not-allowed">
                </div>

                <!-- Analytics -->
                <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-3.5 flex items-start justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-white">Analytics &amp; Telemetry</span>
                        </div>
                        <p class="text-slate-400 mt-1 text-[11px] leading-relaxed">
                            Helps us measure site traffic, identify bottlenecks, and evaluate the performance of our workflow intelligence engine.
                        </p>
                    </div>
                    <input type="checkbox" x-model="analytics" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-500/30 focus:ring-offset-0 mt-1 cursor-pointer">
                </div>

                <!-- Marketing -->
                <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-3.5 flex items-start justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-white">Marketing &amp; Personalization</span>
                        </div>
                        <p class="text-slate-400 mt-1 text-[11px] leading-relaxed">
                            Enables relevant updates and customized content regarding new features and release notes.
                        </p>
                    </div>
                    <input type="checkbox" x-model="marketing" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-emerald-500 focus:ring-emerald-500/30 focus:ring-offset-0 mt-1 cursor-pointer">
                </div>
            </div>

            <!-- Modal Action Buttons -->
            <div class="pt-3 border-t border-slate-800 flex items-center justify-end gap-2.5">
                <button 
                    @click="rejectNonEssential()" 
                    type="button" 
                    class="rounded-xl border border-slate-800 bg-slate-900 px-3 py-2 text-xs font-semibold text-slate-300 hover:bg-slate-800 hover:text-white transition-colors"
                >
                    Reject All
                </button>
                <button 
                    @click="savePreferences()" 
                    type="button" 
                    class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 px-4 py-2 text-xs font-bold text-white shadow-lg shadow-emerald-500/20 hover:from-emerald-400 hover:to-teal-500 transition-all"
                >
                    Save Preferences
                </button>
            </div>
        </div>
    </div>
</div>

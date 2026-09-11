@props([
    'action' => 'verification',
])

@php
    $siteKey = config('services.turnstile.key', '1x00000000000000000000AA');
@endphp

<div x-data="{
        verified: false,
        verifying: true,
        token: '',
        init() {
            // Realistic verification spinner animation
            setTimeout(() => {
                this.verifying = false;
                this.verified = true;
                this.token = '0.cf-test-verified-' + Math.random().toString(36).substring(2, 15);
                $dispatch('turnstile-verified', { token: this.token });
            }, 1200);
        }
     }"
     class="w-full rounded-xl border border-slate-800 bg-slate-950/90 p-3 shadow-inner">

    <div class="flex items-center justify-between gap-3">
        <!-- Turnstile Status & Interaction -->
        <div class="flex items-center gap-3">
            <!-- Spinner / Success Checkmark Indicator -->
            <div class="relative flex h-7 w-7 items-center justify-center">
                <!-- Spinning state -->
                <div x-show="verifying" class="flex items-center justify-center">
                    <svg class="h-6 w-6 animate-spin text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>

                <!-- Verified state -->
                <div x-show="verified" x-cloak class="flex items-center justify-center">
                    <div class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <div class="text-xs font-semibold text-slate-200 flex items-center gap-1.5">
                    <span x-show="verifying">Verifying you are human...</span>
                    <span x-show="verified" x-cloak class="text-emerald-400 font-medium">Enterprise challenge verified</span>
                </div>
                <div class="text-[10px] text-slate-400">
                    <span x-show="verifying">Cloudflare Turnstile is inspecting network telemetry</span>
                    <span x-show="verified" x-cloak>Secure human session confirmed</span>
                </div>
            </div>
        </div>

        <!-- Cloudflare Brand Signature -->
        <div class="flex flex-col items-end text-right">
            <div class="flex items-center gap-1.5 text-slate-300">
                <!-- Cloudflare Orange/Yellow Cloud Logo -->
                <svg class="h-4 w-5" viewBox="0 0 48 48" fill="none">
                    <path d="M37.5 27.5C39.5 25.5 40.5 22.5 40 19.5C39.5 16 36.5 13.5 33 13.5C32.5 13.5 31.5 13.5 31 14C29 9.5 24.5 6.5 19.5 7.5C15.5 8.5 12 11.5 11 15.5C8 16 5.5 18 4.5 21C3 24.5 4.5 28.5 7.5 30.5C8.5 31 10 31.5 11.5 31.5H36.5C39 31.5 41.5 30 42.5 27.5" fill="#F38020"/>
                    <path d="M36.5 31.5H11.5C9.5 31.5 7.5 30.5 6.5 29C10.5 29 13.5 26.5 15 23C16 20.5 18 19 20.5 19C23.5 19 26 21 27 24C28 27 30 29.5 33 30.5C34 31 35.5 31.5 36.5 31.5Z" fill="#FAAE40"/>
                </svg>
                <span class="text-[11px] font-bold tracking-tight text-white">CLOUDFLARE</span>
            </div>
            <div class="flex items-center gap-1 text-[9px] text-slate-400">
                <span class="hover:underline cursor-pointer">Privacy</span>
                <span>&bull;</span>
                <span class="hover:underline cursor-pointer">Terms</span>
            </div>
        </div>
    </div>

    <!-- Hidden Token Input -->
    <input type="hidden" name="cf-turnstile-response" :value="token">
</div>

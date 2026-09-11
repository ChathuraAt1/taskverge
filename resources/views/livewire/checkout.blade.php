<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto mb-10">
        <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-400">
            <span>Enterprise License Provisioning</span>
            <span class="text-slate-500">&bull;</span>
            <span class="text-emerald-400">Instant Activation</span>
        </div>
        <h1 class="text-3xl font-extrabold text-white mt-3">Complete Your TaskVerge Subscription</h1>
        <p class="text-xs text-slate-400 mt-2">Scale operations across your organization with centralized workflow intelligence and automated governance.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg bg-emerald-500/10 border border-emerald-500/30 p-4 text-xs font-medium text-emerald-300">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- LEFT COLUMN: PLAN & PAYMENT CONFIGURATION (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">
            <!-- 1. Plan Selection -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">1. Select Tier & Scale</h3>
                    <!-- Billing Interval Toggle -->
                    <div class="flex items-center rounded-lg border border-slate-800 bg-slate-900 p-0.5 text-xs">
                        <button type="button" wire:click="setBillingInterval('monthly')"
                                class="rounded-md px-3 py-1 transition-colors {{ $billingInterval === 'monthly' ? 'bg-emerald-600 text-white font-semibold' : 'text-slate-400 hover:text-white' }}">
                            Monthly
                        </button>
                        <button type="button" wire:click="setBillingInterval('annual')"
                                class="flex items-center gap-1 rounded-md px-3 py-1 transition-colors {{ $billingInterval === 'annual' ? 'bg-emerald-600 text-white font-semibold' : 'text-slate-400 hover:text-white' }}">
                            Annual
                            <span class="rounded bg-emerald-500/20 px-1 py-0.2 text-[9px] font-bold text-emerald-300 uppercase">Save 20%</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Operations Core -->
                    <div wire:click="setPlan('core')"
                         class="cursor-pointer rounded-xl border p-4 transition-all relative {{ $plan === 'core' ? 'border-emerald-500 bg-emerald-950/20 ring-1 ring-emerald-500' : 'border-slate-800 bg-slate-900/60 hover:border-slate-700' }}">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase text-slate-300">Operations Core</span>
                            <span class="h-4 w-4 rounded-full border flex items-center justify-center {{ $plan === 'core' ? 'border-emerald-500 bg-emerald-600' : 'border-slate-600' }}">
                                @if($plan === 'core') <span class="h-1.5 w-1.5 rounded-full bg-white"></span> @endif
                            </span>
                        </div>
                        <div class="mt-2 text-xl font-bold text-white">
                            ${{ $billingInterval === 'annual' ? '39' : '49' }}
                            <span class="text-xs text-slate-400 font-normal">/ seat / mo</span>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Multi-stage pipelines, Kanban boards, and standard audit logging.</p>
                    </div>

                    <!-- Enterprise Intelligence -->
                    <div wire:click="setPlan('intelligence')"
                         class="cursor-pointer rounded-xl border p-4 transition-all relative {{ $plan === 'intelligence' ? 'border-emerald-500 bg-emerald-950/20 ring-1 ring-emerald-500' : 'border-slate-800 bg-slate-900/60 hover:border-slate-700' }}">
                        <div class="absolute -top-2.5 right-3 rounded-full bg-emerald-600 px-2 py-0.5 text-[9px] font-bold uppercase text-white tracking-wider">
                            AI Engine
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase text-slate-300">Intelligence Tier</span>
                            <span class="h-4 w-4 rounded-full border flex items-center justify-center {{ $plan === 'intelligence' ? 'border-emerald-500 bg-emerald-600' : 'border-slate-600' }}">
                                @if($plan === 'intelligence') <span class="h-1.5 w-1.5 rounded-full bg-white"></span> @endif
                            </span>
                        </div>
                        <div class="mt-2 text-xl font-bold text-white">
                            ${{ $billingInterval === 'annual' ? '95' : '119' }}
                            <span class="text-xs text-slate-400 font-normal">/ seat / mo</span>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1">Includes Triton multi-GPU inference, Nemotron reasoning, and predictive bottleneck triage.</p>
                    </div>
                </div>

                <!-- Seats Counter -->
                <div class="pt-3 border-t border-slate-900 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-200">Authorized Operator Seats</span>
                        <p class="text-[11px] text-slate-400">Total concurrent enterprise team members</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" wire:click="decrementSeats" class="h-8 w-8 rounded-lg border border-slate-700 bg-slate-900 text-slate-300 hover:bg-slate-800 font-bold flex items-center justify-center">
                            -
                        </button>
                        <span class="font-mono text-base font-bold text-white w-6 text-center">{{ $seats }}</span>
                        <button type="button" wire:click="incrementSeats" class="h-8 w-8 rounded-lg border border-slate-700 bg-slate-900 text-slate-300 hover:bg-slate-800 font-bold flex items-center justify-center">
                            +
                        </button>
                    </div>
                </div>
            </div>

            <!-- 2. Payment Method Form -->
            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">2. Payment Method</h3>
                    <div class="flex items-center gap-1.5 text-xs text-slate-400">
                        <svg class="h-3.5 w-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>256-Bit Encrypted</span>
                    </div>
                </div>

                <form wire:submit="processCheckout" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-300">Cardholder Full Name</label>
                        <input type="text" wire:model="cardholderName" placeholder="Alexander Hayes"
                               class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-xs text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                        @error('cardholderName') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                    </div>

                    <!-- Card Number Input with Real-time Brand Badge -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-medium text-slate-300">Corporate Card Number</label>
                            <span class="text-[11px] font-semibold text-emerald-400">{{ $this->cardBrand }}</span>
                        </div>
                        <div class="relative mt-1">
                            <input type="text" wire:model.live.debounce.150ms="cardNumber" placeholder="4242 4242 4242 4242"
                                   class="block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 pl-10 text-xs font-mono text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                            <!-- Card Icon -->
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </div>
                        </div>
                        @error('cardNumber') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Expiration Date</label>
                            <input type="text" wire:model="cardExpiry" placeholder="MM/YY" maxlength="5"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-xs font-mono text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                            @error('cardExpiry') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Security CVC</label>
                            <input type="password" wire:model="cardCvc" placeholder="123" maxlength="4"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-xs font-mono text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                            @error('cardCvc') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-300">Country / Region</label>
                            <select wire:model="country"
                                    class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-xs text-slate-100 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                <option value="United States">United States</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Canada">Canada</option>
                                <option value="Germany">Germany</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Japan">Japan</option>
                                <option value="Australia">Australia</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-300">Postal / ZIP Code</label>
                            <input type="text" wire:model="postalCode" placeholder="10001"
                                   class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-xs text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                            @error('postalCode') <span class="text-[11px] text-rose-400">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Cloudflare Turnstile Verification Spin Component -->
                    <div class="pt-2">
                        <x-turnstile action="checkout" />
                    </div>

                    <!-- Action Button -->
                    <div class="pt-3">
                        <button type="submit"
                                class="w-full rounded-xl bg-emerald-600 py-3 px-4 text-sm font-bold text-white shadow-lg shadow-emerald-600/30 hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950 transition-all flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Confirm & Authorize ${{ number_format($this->total, 2) }} USD
                        </button>
                        <p class="text-[10px] text-center text-slate-400 mt-2">
                            By confirming, you authorize TaskVerge Technologies Inc. to charge your corporate card on an ongoing {{ $billingInterval }} basis.
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT COLUMN: ORDER SUMMARY & ENTERPRISE INVOICE PREVIEW (5 Cols) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="rounded-xl border border-slate-800 bg-slate-950/80 p-5 shadow-sm space-y-4 sticky top-24">
                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Order Summary</h3>
                    <span class="rounded bg-emerald-500/10 px-2 py-0.5 text-[10px] font-mono text-emerald-400 border border-emerald-500/20">
                        USD Currency
                    </span>
                </div>

                <!-- Line Item Details -->
                <div class="space-y-3 text-xs">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="font-semibold text-slate-200">
                                {{ $plan === 'intelligence' ? 'Enterprise Intelligence' : 'Operations Core' }}
                            </span>
                            <p class="text-slate-400 mt-0.5">
                                {{ $seats }} operator seats &bull; {{ ucfirst($billingInterval) }} commitment (${{ number_format($this->unitRate, 2) }}/seat/mo)
                            </p>
                        </div>
                        <span class="font-mono font-semibold text-slate-100">
                            ${{ number_format($this->subtotal, 2) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between text-slate-400 pt-2 border-t border-slate-900">
                        <span>Corporate Excise / VAT (8.25%)</span>
                        <span class="font-mono text-slate-300">${{ number_format($this->tax, 2) }}</span>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-slate-800 text-sm">
                        <span class="font-bold text-white">Total Due Today</span>
                        <span class="font-mono text-lg font-bold text-emerald-400">${{ number_format($this->total, 2) }}</span>
                    </div>
                </div>

                <!-- Included Capabilities -->
                <div class="rounded-lg bg-slate-900/80 border border-slate-800/80 p-3.5 space-y-2 text-xs">
                    <span class="font-semibold text-white uppercase tracking-wider text-[10px] block">Subscription Entitlements:</span>
                    <ul class="text-slate-300 space-y-1.5 text-[11px]">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400 font-bold">&check;</span>
                            Full access to all {{ $seats }} operator workspaces &amp; Team Hub
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400 font-bold">&check;</span>
                            {{ $plan === 'intelligence' ? 'Unlimited AI Copilot queries & custom LLM keys' : '500 AI Copilot queries / month' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400 font-bold">&check;</span>
                            {{ $plan === 'intelligence' ? 'Unlimited analytics history & predictive forecasting' : '90-day analytics & SLA risk telemetry' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400 font-bold">&check;</span>
                            {{ $plan === 'intelligence' ? 'Permanent immutable compliance audit trail' : '90-day compliance audit retention & CSV export' }}
                        </li>
                        @if($plan === 'intelligence')
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-400 font-bold">&check;</span>
                                NVIDIA Triton inference server acceleration &amp; Nemotron
                            </li>
                        @endif
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400 font-bold">&check;</span>
                            Downloadable corporate VAT receipts &amp; invoices
                        </li>
                    </ul>
                </div>

                <!-- Enterprise Guarantee -->
                <div class="flex items-center gap-3 pt-1 text-[11px] text-slate-400">
                    <svg class="h-6 w-6 text-slate-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Instant provisioning. Your enterprise environment will be upgraded immediately upon network authorization.</span>
                </div>
            </div>
        </div>
    </div>
</div>

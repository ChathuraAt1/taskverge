<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Success Banner -->
    <div class="text-center space-y-3 mb-8">
        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 shadow-lg shadow-emerald-500/10">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Payment Confirmed & License Provisioned</h1>
        <p class="text-xs sm:text-sm text-slate-400">
            Transaction authorized. Your enterprise environment has been upgraded to <strong class="text-slate-200">{{ $order->plan_name }}</strong>.
        </p>
    </div>

    <!-- Official Corporate Invoice Card -->
    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-6 sm:p-8 shadow-2xl space-y-6">
        <!-- Invoice Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-800 pb-5">
            <div class="flex items-center gap-2.5">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-600 text-white font-bold text-xs">
                    TV
                </div>
                <div>
                    <span class="text-base font-bold text-white tracking-tight">Task<span class="text-indigo-400">Verge</span> Technologies Inc.</span>
                    <p class="text-[10px] text-slate-400">Enterprise Workflow Intelligence System</p>
                </div>
            </div>

            <div class="text-left sm:text-right">
                <span class="text-xs uppercase font-mono font-bold text-indigo-400">{{ $order->invoice_number }}</span>
                <p class="text-[11px] text-slate-400 mt-0.5">{{ $order->created_at->format('F d, Y &bull; H:i:s T') }}</p>
            </div>
        </div>

        <!-- Billing To & Payment Meta -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
            <div class="rounded-lg bg-slate-900/60 p-3.5 border border-slate-800/80">
                <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 block mb-1">Billed To</span>
                <div class="font-semibold text-slate-200">{{ $order->user->name }}</div>
                <div class="text-slate-400">{{ $order->user->email }}</div>
                <div class="text-slate-400">{{ $order->user->department ?? 'Enterprise Operations' }}</div>
            </div>

            <div class="rounded-lg bg-slate-900/60 p-3.5 border border-slate-800/80">
                <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 block mb-1">Payment Details</span>
                <div class="flex items-center gap-2 text-slate-200 font-medium">
                    <span class="rounded bg-slate-800 px-1.5 py-0.5 font-mono text-[10px]">{{ $order->card_brand }}</span>
                    <span>ending in <strong class="font-mono text-white">{{ $order->card_last_four }}</strong></span>
                </div>
                <div class="text-emerald-400 font-semibold mt-1 flex items-center gap-1.5">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    <span>Status: Paid & Settled (USD)</span>
                </div>
            </div>
        </div>

        <!-- Itemized Table -->
        <div class="border border-slate-800 rounded-xl overflow-hidden">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-900 text-slate-400 uppercase text-[10px] font-semibold border-b border-slate-800">
                    <tr>
                        <th class="px-4 py-2.5">Subscription Plan</th>
                        <th class="px-4 py-2.5">Billing Cadence</th>
                        <th class="px-4 py-2.5 text-center">Seats</th>
                        <th class="px-4 py-2.5 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80 text-slate-200">
                    <tr>
                        <td class="px-4 py-3 font-medium">
                            {{ $order->plan_name }}
                        </td>
                        <td class="px-4 py-3 text-slate-400 capitalize">
                            {{ $order->billing_interval }}
                        </td>
                        <td class="px-4 py-3 text-center font-mono">
                            {{ $order->seats }}
                        </td>
                        <td class="px-4 py-3 text-right font-mono font-semibold">
                            ${{ number_format($order->subtotal, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Totals Summary -->
        <div class="space-y-1.5 text-xs text-slate-300 pt-2 border-t border-slate-800">
            <div class="flex justify-between">
                <span class="text-slate-400">Subtotal:</span>
                <span class="font-mono">${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Excise / Corporate Tax (8.25%):</span>
                <span class="font-mono">${{ number_format($order->tax, 2) }}</span>
            </div>
            <div class="flex justify-between pt-2 border-t border-slate-800 text-sm font-bold text-white">
                <span>Total Paid:</span>
                <span class="font-mono text-indigo-400">${{ number_format($order->total, 2) }} USD</span>
            </div>
        </div>

        <!-- Action Controls -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-4 border-t border-slate-800">
            <button onclick="window.print()" type="button"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Print / Save PDF Invoice
            </button>

            <a href="{{ route('dashboard') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2 text-xs font-semibold text-white hover:bg-indigo-500 shadow-md transition-colors">
                <span>Launch Operational Workspace</span>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
    </div>
</div>

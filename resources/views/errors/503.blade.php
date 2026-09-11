@extends('errors.layout')

@section('title', '503 Service Unavailable - Maintenance Active')
@section('code', '503')
@section('status', 'Maintenance Mode')
@section('badge_bg', 'bg-amber-500/10 border border-amber-500/30 text-amber-400')
@section('dot_color', 'bg-amber-400')

@section('icon')
<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 3.096l-.164.164" />
</svg>
@endsection

@section('heading', 'Platform Scheduled Maintenance')

@section('message')
TaskVerge is currently performing routine pipeline maintenance and database optimization routines. Normal service will resume shortly.
@endsection

@section('actions')
<button onclick="window.location.reload()" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
    </svg>
    <span>Check System Status</span>
</button>
@endsection

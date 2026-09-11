@extends('errors.layout')

@section('title', '419 Page Expired - Session Timed Out')
@section('code', '419')
@section('status', 'Page Expired')
@section('badge_bg', 'bg-amber-500/10 border border-amber-500/30 text-amber-400')
@section('dot_color', 'bg-amber-400')

@section('icon')
<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
@endsection

@section('heading', 'Session Security Verification Expired')

@section('message')
Your security token has expired due to session inactivity. Please refresh the page and try submitting your request again.
@endsection

@section('actions')
<button onclick="window.location.reload()" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
    </svg>
    <span>Refresh Page</span>
</button>
<a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 px-4 py-2.5 text-xs font-semibold text-slate-200 transition-colors">
    <span>Return to Login</span>
</a>
@endsection

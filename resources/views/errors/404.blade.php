@extends('errors.layout')

@section('title', '404 Not Found - Page Not Found')
@section('code', '404')
@section('status', 'Page Not Found')
@section('badge_bg', 'bg-blue-500/10 border border-blue-500/30 text-blue-400')
@section('dot_color', 'bg-blue-400')

@section('icon')
<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
</svg>
@endsection

@section('heading', 'Resource or Pipeline Endpoint Not Found')

@section('message')
The page or workflow endpoint you requested does not exist or may have been relocated across the network.
@endsection

@section('actions')
@auth
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
        <span>Go to Dashboard</span>
    </a>
    <a href="{{ route('workflows.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 px-4 py-2.5 text-xs font-semibold text-slate-200 transition-colors">
        <span>Browse Workflows</span>
    </a>
@else
    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
        <span>Return to Homepage</span>
    </a>
    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 px-4 py-2.5 text-xs font-semibold text-slate-200 transition-colors">
        <span>Sign In</span>
    </a>
@endauth
@endsection

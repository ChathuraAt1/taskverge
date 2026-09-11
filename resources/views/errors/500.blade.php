@extends('errors.layout')

@section('title', '500 Server Error - Internal Operational Issue')
@section('code', '500')
@section('status', 'Internal Server Error')
@section('badge_bg', 'bg-rose-500/10 border border-rose-500/30 text-rose-400')
@section('dot_color', 'bg-rose-400')

@section('icon')
<svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
</svg>
@endsection

@section('heading', 'Internal Operational Exception')

@section('message')
An unexpected exception occurred while processing this request. Our automated observability systems have logged the incident details.
@endsection

@section('actions')
<button onclick="window.location.reload()" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-emerald-600/20 transition-all">
    <span>Try Again</span>
</button>
<a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 px-4 py-2.5 text-xs font-semibold text-slate-200 transition-colors">
    <span>Return to Home</span>
</a>
@endsection

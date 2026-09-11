@extends('layouts.guest')

@section('content')
<div class="flex min-h-[calc(100vh-4rem)] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white shadow-lg shadow-indigo-500/25">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-bold tracking-tight text-white">Sign in to TaskVerge</h2>
            <p class="mt-1 text-sm text-slate-400">Enterprise Workflow & Operational Intelligence</p>
        </div>

        <!-- 1-Click Instant Evaluation Personas -->
        <div class="rounded-xl border border-indigo-500/30 bg-indigo-950/20 p-4">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-indigo-400">1-Click Evaluation Personas</span>
                <span class="text-[10px] rounded bg-indigo-500/20 px-2 py-0.5 text-indigo-300">Instant Access</span>
            </div>
            <div class="space-y-2">
                @foreach($demoUsers as $demo)
                    <form method="POST" action="{{ route('quick-login', $demo) }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-between rounded-lg border border-slate-800 bg-slate-900/80 px-3 py-2 text-left hover:border-indigo-500 hover:bg-slate-800 transition-all group">
                            <div class="flex items-center gap-2.5">
                                <img class="h-7 w-7 rounded-full object-cover" src="{{ $demo->avatar }}" alt="">
                                <div>
                                    <p class="text-xs font-semibold text-slate-200 group-hover:text-indigo-300">{{ $demo->name }}</p>
                                    <p class="text-[11px] text-slate-400">{{ $demo->title ?? $demo->department }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded
                                {{ $demo->role === 'admin' ? 'bg-purple-500/20 text-purple-300' : ($demo->role === 'manager' ? 'bg-indigo-500/20 text-indigo-300' : 'bg-emerald-500/20 text-emerald-300') }}">
                                {{ $demo->role }}
                            </span>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>

        <!-- Standard Login Form -->
        <div class="rounded-xl border border-slate-800 bg-slate-900/80 p-6 shadow-xl backdrop-blur-sm">
            <form class="space-y-4" action="{{ route('login') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="rounded-lg bg-rose-500/10 border border-rose-500/30 p-3 text-xs text-rose-300">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-xs font-medium text-slate-300">Work Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-medium text-slate-300">Password</label>
                    </div>
                    <input id="password" name="password" type="password" required
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-indigo-600 focus:ring-indigo-500">
                        <label for="remember" class="ml-2 block text-xs text-slate-400">Remember credentials</label>
                    </div>
                    <span class="text-xs text-slate-400">Default pwd: <code class="text-indigo-400 font-mono">password</code></span>
                </div>

                <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 py-2.5 px-4 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-colors">
                    Sign in to Workspace
                </button>
            </form>

            <div class="mt-4 pt-4 border-t border-slate-800 text-center text-xs text-slate-400">
                New to TaskVerge?
                <a href="{{ route('register') }}" class="font-medium text-indigo-400 hover:text-indigo-300">Register new enterprise account</a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.guest')

@section('content')
<div class="flex min-h-[calc(100vh-4rem)] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-6">
        <div class="text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white shadow-lg shadow-indigo-500/25">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.765z" />
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-bold tracking-tight text-white">Create Your Account</h2>
            <p class="mt-1 text-sm text-slate-400">Start managing your workflows smarter</p>
        </div>

        <!-- Google OAuth Authentication Button -->
        <div>
            <a href="{{ route('auth.google') }}"
               class="w-full flex items-center justify-center gap-3 rounded-xl border border-slate-700 bg-slate-900/90 py-2.5 px-4 text-sm font-semibold text-slate-100 hover:bg-slate-800 hover:border-slate-600 transition-all shadow-sm">
                <!-- Google SVG Logo -->
                <svg class="h-4 w-4" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                </svg>
                Sign up with Google Workspace
            </a>
        </div>

        <div class="relative flex items-center justify-center">
            <div class="w-full border-t border-slate-800"></div>
            <span class="absolute bg-slate-950 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500">OR DIRECT REGISTRATION</span>
        </div>

        <div class="rounded-xl border border-slate-800 bg-slate-900/80 p-6 shadow-xl backdrop-blur-sm">
            <form class="space-y-4" action="{{ route('register') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="rounded-lg bg-rose-500/10 border border-rose-500/30 p-3 text-xs text-rose-300">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <label for="name" class="block text-xs font-medium text-slate-300">Full Name</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="e.g. Jordan Miller"
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="email" class="block text-xs font-medium text-slate-300">Email Address</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="jordan@company.com"
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium text-slate-300">Password</label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-slate-300">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <!-- Cloudflare Turnstile Verification Spin -->
                <x-turnstile action="register" />

                <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 py-2.5 px-4 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-colors">
                    Complete Registration
                </button>
            </form>

            <div class="mt-4 pt-4 border-t border-slate-800 text-center text-xs text-slate-400">
                Already registered?
                <a href="{{ route('login') }}" class="font-medium text-indigo-400 hover:text-indigo-300">Sign in with credentials</a>
            </div>
        </div>
    </div>
</div>
@endsection

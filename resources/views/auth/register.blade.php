@extends('layouts.guest')

@section('content')
<div class="flex min-h-[calc(100vh-4rem)] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-6">
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block mb-3">
                <img src="{{ asset('images/logo.webp') }}" alt="TaskVerge" class="h-11 w-auto mx-auto object-contain brightness-110">
            </a>
            <h2 class="text-2xl font-bold tracking-tight text-white">Create Your Account</h2>
            <p class="mt-1 text-sm text-slate-400">Start managing your workflows smarter with autonomous AI</p>
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
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label for="email" class="block text-xs font-medium text-slate-300">Email Address</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="jordan@company.com"
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium text-slate-300">Password</label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-slate-300">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                </div>

                <!-- Cloudflare Turnstile Verification Spin -->
                <x-turnstile action="register" />

                <button type="submit"
                        class="w-full rounded-lg bg-emerald-600 py-2.5 px-4 text-sm font-semibold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-colors">
                    Complete Registration
                </button>
            </form>

            <div class="mt-4 pt-4 border-t border-slate-800 text-center text-xs text-slate-400">
                Already registered?
                <a href="{{ route('login') }}" class="font-medium text-emerald-400 hover:text-emerald-300">Sign in with credentials</a>
            </div>
        </div>
    </div>
</div>
@endsection

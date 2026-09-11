@extends('layouts.guest')

@section('content')
<div class="flex min-h-[calc(100vh-4rem)] items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white shadow-lg shadow-indigo-500/25">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.765z" />
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-bold tracking-tight text-white">Create Enterprise Account</h2>
            <p class="mt-1 text-sm text-slate-400">Join the TaskVerge Workflow Intelligence network</p>
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
                    <label for="email" class="block text-xs font-medium text-slate-300">Corporate Email</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="jordan@company.com"
                           class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="department" class="block text-xs font-medium text-slate-300">Department</label>
                        <select id="department" name="department" required
                                class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            <option value="Enterprise Operations">Operations</option>
                            <option value="Global Logistics & Supply Chain">Logistics</option>
                            <option value="Regulatory Compliance">Compliance</option>
                            <option value="Cloud Infrastructure">Engineering</option>
                        </select>
                    </div>

                    <div>
                        <label for="role" class="block text-xs font-medium text-slate-300">Target Role</label>
                        <select id="role" name="role" required
                                class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            <option value="operator">Operator</option>
                            <option value="manager">Operations Manager</option>
                            <option value="admin">Workflow Admin</option>
                        </select>
                    </div>
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

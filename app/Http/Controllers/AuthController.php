<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $isLocal = app()->environment('local', 'testing');

        $demoUsers = $isLocal ? User::query()->whereIn('email', [
            'admin@taskverge.com',
            'manager@taskverge.com',
            'operator@taskverge.com',
        ])->get() : collect();

        return view('auth.login', compact('demoUsers', 'isLocal'));
    }

    /**
     * Handle standard login attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our enterprise records.',
        ])->onlyInput('email');
    }

    /**
     * Fast 1-click login for evaluation and persona testing.
     */
    public function quickLogin(Request $request, User $user): RedirectResponse
    {
        abort_unless(app()->environment('local', 'testing'), 404);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('status', "Logged in as {$user->name} ({$user->role})");
    }

    /**
     * Show registration form.
     */
    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    /**
     * Handle registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => 'member',
            'subscription_plan' => 'free',
            'subscription_status' => 'trialing',
            'password' => Hash::make($validated['password']),
            'is_active' => true,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('status', 'Welcome to TaskVerge Enterprise Platform.');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

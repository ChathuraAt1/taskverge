<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Livewire\AdminPanel;
use App\Livewire\Checkout;
use App\Livewire\CheckoutSuccess;
use App\Livewire\Dashboard;
use App\Livewire\TasksIndex;
use App\Livewire\WorkflowsIndex;
use App\Livewire\WorkflowWorkspace;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - TaskVerge Enterprise Platform
|--------------------------------------------------------------------------
*/

// Public Technical Product Landing Page
Route::view('/', 'landing')->name('home');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Fast 1-Click Evaluation Login (supports quick persona switching in dev/testing)
Route::post('/quick-login/{user}', [AuthController::class, 'quickLogin'])->name('quick-login');

// Enterprise Checkout & Subscription Billing
Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/checkout/success/{order}', CheckoutSuccess::class)->name('checkout.success')->middleware('auth');

// Authenticated Enterprise Application Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('app')->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/workflows', WorkflowsIndex::class)->name('workflows.index');
        Route::get('/workflows/{workflow:slug}', WorkflowWorkspace::class)->name('workflows.show');
        Route::get('/tasks', TasksIndex::class)->name('tasks.index');
        Route::get('/admin', AdminPanel::class)->name('admin.panel');
    });
});

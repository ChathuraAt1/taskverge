<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\InstallController;
use App\Livewire\AdminPanel;
use App\Livewire\AnalyticsDashboard;
use App\Livewire\AuditLog;
use App\Livewire\Checkout;
use App\Livewire\CheckoutSuccess;
use App\Livewire\CopilotWorkspace;
use App\Livewire\Dashboard;
use App\Livewire\TasksIndex;
use App\Livewire\TeamHub;
use App\Livewire\WorkflowsIndex;
use App\Livewire\WorkflowWorkspace;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - TaskVerge Enterprise Platform
|--------------------------------------------------------------------------
*/

// Public Technical Product Landing Page & Contact
Route::view('/', 'landing')->name('home');
Route::view('/product', 'product')->name('product');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// System & Database Installer (gated via ENABLE_INSTALLER_ROUTE in .env)
Route::get('/install', [InstallController::class, 'index'])->name('install.index');
Route::post('/install', [InstallController::class, 'execute'])->name('install.execute');

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
        Route::get('/copilot', CopilotWorkspace::class)->name('copilot');
        Route::get('/workflows', WorkflowsIndex::class)->name('workflows.index');
        Route::get('/workflows/{workflow:slug}', WorkflowWorkspace::class)->name('workflows.show');
        Route::get('/tasks', TasksIndex::class)->name('tasks.index');
        Route::get('/analytics', AnalyticsDashboard::class)->name('analytics');
        Route::get('/team', TeamHub::class)->name('team');
        Route::get('/audit', AuditLog::class)->name('audit');
        Route::get('/admin', AdminPanel::class)->name('admin.panel');
    });
});

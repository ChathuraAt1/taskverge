<?php

use App\Http\Controllers\AuthController;
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

// Fast 1-Click Evaluation Login (supports quick persona switching in dev/testing)
Route::post('/quick-login/{user}', [AuthController::class, 'quickLogin'])->name('quick-login');

// Authenticated Enterprise Application Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('app')->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/workflows', WorkflowsIndex::class)->name('workflows.index');
        Route::get('/workflows/{workflow:slug}', WorkflowWorkspace::class)->name('workflows.show');
        Route::get('/tasks', TasksIndex::class)->name('tasks.index');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;

// Root → login page
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard — both admin and student
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin-only routes
    Route::middleware(['admin'])->group(function () {
        Route::resource('events', EventController::class);
    });

});

// Load all Breeze auth routes (login, logout, register, password reset)
require __DIR__.'/auth.php';
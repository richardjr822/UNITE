<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;

// public auth routes (login, register) already handled by Breeze

Route::middleware(['auth'])->group(function () {

    // dashboard — both admin and student
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // admin only
    Route::middleware(['admin'])->group(function () {
        Route::resource('events', EventController::class);
    });

});
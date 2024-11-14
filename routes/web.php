<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AcademicSubgroupController;

// Routes publiques
Route::get('/', function () {
    return Inertia::render('LoginPage');
})->name('login');

// Routes d'authentification
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Routes pour les utilisateurs avec des rôles spécifiques
Route::middleware(['auth', 'check.role:reader'])->group(function () {
    Route::get('/reader/calendar', function () {
        return Inertia::render('ReaderCalendarPage');
    })->name('reader.calendar');
});

Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin/calendar', function () {
        return Inertia::render('AdminCalendarPage');
    })->name('admin.calendar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/subgroups', [AcademicSubgroupController::class, 'index'])->name('subgroups.index');
});
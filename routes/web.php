<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Routes publiques
Route::get('/', function () {
    return Inertia::render('LoginPage');
})->name('login');

// Routes d'authentification
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Routes pour l'administrateur
Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin/calendar', function () {
        return Inertia::render('AdminCalendarPage');
    })->name('admin.calendar');

    Route::get('/groupes', function () {
        return Inertia::render('GroupPage');
    })->name('groupes');

    Route::get('/enseignants', function () {
        return Inertia::render('TeachersTeachingsPageContent');
    })->name('enseignants');

    Route::get('/alertes', function () {
        return Inertia::render('AlertPage');
    })->name('alertes');

    Route::get('/configurations', function () {
        return Inertia::render('ConfigPage');
    })->name('configurations');
});

// Routes pour le lecteur standard
Route::middleware(['auth', 'check.role:reader'])->group(function () {
    Route::get('/reader/calendar', function () {
        return Inertia::render('ReaderCalendarPage');
    })->name('reader.calendar');
});

// Routes pour le lecteur privilégié
Route::middleware(['auth', 'check.role:extended_reader'])->group(function () {
    Route::get('/extended/calendar', function () {
        return Inertia::render('ExtendedReaderCalendarPage');
    })->name('extended.calendar');
});

// Routes communes à tous les utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    Route::get('/edt', function () {
        return Inertia::render('ServicePage');
    })->name('edt');

    Route::get('/service', function () {
        return Inertia::render('ServicePage');
    })->name('service');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProvisionnalCalendarEditorController;
use App\Http\Controllers\ProvisionnalCalendarSettingsController;
use App\Http\Controllers\TeachersTeachingsController;
use App\Http\Controllers\ProvisionnalCalendarReaderController;
use App\Http\Controllers\WorkInProgressController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::get('/', [IndexController::class, 'show'])->middleware(['auth'])->name('index');

Route::get('/calendrier-previsionnel', [ProvisionnalCalendarReaderController::class, 'show'])
    ->middleware(['auth', 'role:reader', 'role:extended_reader'])
    ->name('provisionnal_calendar');

Route::get('/edt', [WorkInProgressController::class, 'show'])
    ->middleware(['auth', 'role:reader', 'role:extended_reader', 'role:admin'])
    ->name('edt');

Route::get('/service', [WorkInProgressController::class, 'show'])
    ->middleware(['auth', 'role:reader', 'role:extended_reader', 'role:admin'])
    ->name('service');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/calendrier-previsionnel/groupes', [GroupsController::class, 'show'])
        ->name('provisionnal_calendar.groups');

    Route::get('/calendrier-previsionnel/enseignants-enseignements', [TeachersTeachingsController::class, 'show'])
        ->name('provisionnal_calendar.teachers_teachings');

    Route::get('/calendrier-previsionnel/editeur', [ProvisionnalCalendarEditorController::class, 'show'])
        ->name('provisionnal_calendar.editor');

    Route::get('/calendrier-previsionnel/configurations', [ProvisionnalCalendarSettingsController::class, 'show'])
        ->name('provisionnal_calendar.settings');
});

Route::get('/admin-calendar', function () {
    return Inertia::render('AdminCalendarPage');
})->name('admin-calendar');

Route::get('/edt', function () {
    return Inertia::render('EDTPage');
})->name('edt');

Route::get('/service', function () {
    return Inertia::render('ServicePage');
})->name('service');

Route::get('/groupes', function () {
    return Inertia::render('GroupPage');
})->name('groupes');

Route::get('/alertes', function () {
    return Inertia::render('AlertPage');
})->name('alertes');

Route::get('/configurations', function () {
    return Inertia::render('ConfigPage');
})->name('configurations');

Route::get('/enseignants', function () {
    return Inertia::render('TeachersTeachingsPageContent');
})->name('enseignants');

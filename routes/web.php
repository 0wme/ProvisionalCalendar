<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProvisionnalCalendarEditorController;
use App\Http\Controllers\ProvisionnalCalendarSettingsController;
use App\Http\Controllers\TeachersTeachingsController;
use App\Http\Controllers\ProvisionnalCalendarReaderController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [IndexController::class, 'show'])->middleware(['auth'])->name('index');

Route::get('/calendrier-previsionnel', [ProvisionnalCalendarReaderController::class, 'show'])
    ->middleware(['auth', 'role:reader', 'role:extended_reader'])
    ->name('provisionnal_calendar');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/calendrier-previsionnel/groupes', [GroupsController::class, 'show'])
        ->name('provisionnal_calendar.groups');

    Route::get('/calendrier-previsionnel/teachers-teachings', [TeachersTeachingsController::class, 'show'])
        ->name('provisionnal_calendar.teachers_teachings');

    Route::get('/calendrier-previsionnel/editor', [ProvisionnalCalendarEditorController::class, 'show'])
        ->name('provisionnal_calendar.editor');

    Route::get('/calendrier-previsionnel/settings', [ProvisionnalCalendarSettingsController::class, 'show'])
        ->name('provisionnal_calendar.settings');

    // Route::get('/edt', [DashboardController::class, 'show'])
    //     ->name('edt');

    // Route::get('/service', [DashboardController::class, 'show'])
    //     ->name('service');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

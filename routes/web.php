<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('TeachersTeachingsPageContent');
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
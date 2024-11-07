<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('LoginPage');
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

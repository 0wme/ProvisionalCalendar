<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/result', [AuthController::class, 'result'])
    ->name('result')
    ->middleware('auth');

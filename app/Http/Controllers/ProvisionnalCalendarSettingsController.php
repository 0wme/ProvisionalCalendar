<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProvisionnalCalendarSettingsController extends Controller
{
    public function show()
    {
        return Inertia::render('ConfigPage');
    }
}

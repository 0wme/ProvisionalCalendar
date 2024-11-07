<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->route('result');
        }

        return back()->withErrors([
            'username' => 'Identifiant ou mot de passe incorrect.',
        ]);
    }

    public function result()
    {
        $user = Auth::user();
        $message = match ($user->role->name) {
            'admin' => 'Bienvenue administrateur !',
            'reader' => 'Bienvenue lecteur basique !',
            'extended_reader' => 'Bienvenue lecteur privilégié !',
            default => 'Bienvenue !',
        };

        return Inertia::render('Result', [
            'message' => $message
        ]);
    }
} 
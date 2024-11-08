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
            $user = Auth::user();
            
            // Redirection basée sur le rôle avec chemins directs
            $route = match ($user->role->name) {
                'admin' => '/admin/calendar',
                'reader' => '/reader/calendar',
                'extended_reader' => '/extended/calendar',
                default => '/'
            };

            return redirect($route)->with([
                'message' => "Vous êtes connecté en tant que {$user->firstname} {$user->lastname}",
                'role' => $user->role->name
            ]);
        }

        return back()->withErrors([
            'username' => 'Identifiants incorrects.',
        ]);
    }

    public function checkRole(Request $request, string $requiredRole)
    {
        $user = Auth::user();
        if (!$user || $user->role->name !== $requiredRole) {
            return redirect('/')->with('error', 'Accès non autorisé.');
        }
        return true;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}

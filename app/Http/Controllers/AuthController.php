<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login ()
    {
        
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request) 
    {
        $credentials = $request->validated();
        // Vérifie si l'utilisateur est connecté
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.property.index'));
        }
        // Si l'utilisateur n'a pas pu se connecter
        return back()->withErrors([
            'email' => 'Identifiants incorrect'
        ])->onlyInput('email');
    }

    public function logout() 
    {
        Auth::logout();
        return to_route('login')->with('success', 'Vous êtes déconnecté');
    }
}

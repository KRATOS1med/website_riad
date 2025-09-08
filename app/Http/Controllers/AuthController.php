<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Vues de connexion
    public function showClientLogin()
    {
        return view('auth.client-login');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function showClientRegister()
    {
        return view('auth.client-register');
    }

    // Redirection après connexion
    public function redirectAfterLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::guard('client')->check()) {
            return redirect()->route('client.dashboard');
        }
        
        return redirect()->route('home');
    }
}

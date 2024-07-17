<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => 'Login - SMPK',
        ]);
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            // Authentication passed
            return redirect()->intended('dashboard');
        }

        // Authentication failed
        return redirect()->back()->withInput()->withErrors(['error' => 'Username/Email atau Password Salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

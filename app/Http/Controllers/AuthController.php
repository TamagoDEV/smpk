<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login', [
            'title' => 'Login - SMPK',
        ]);
    }

    public function processLogin(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        // Check if input is email
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $login,
            'password' => $password
        ];

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
        return redirect('/auth/login');
    }
}

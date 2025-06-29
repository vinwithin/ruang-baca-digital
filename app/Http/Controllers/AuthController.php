<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);
        if (Auth::attempt($validateData)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withInput()->with('error', 'Invalid Username and Password!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Successfully logged out!');
    }
}

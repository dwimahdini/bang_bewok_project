<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Arahkan ke resources/views/login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role pengguna
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.beranda');
                case 'staf':
                    return redirect()->route('staf.beranda');
                case 'manajer':
                    return redirect()->route('manajer.beranda');
                default:
                    Auth::logout(); // Logout jika role tidak valid
                    return back()->withErrors(['email' => 'Role tidak valid.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
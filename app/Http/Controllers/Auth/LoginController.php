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
    public function autentic(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    // Cek kredensial dan login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Redirect berdasarkan peran
        if ($user->role === 'staf') {
            return redirect()->intended('/berandaStaf'); // Rute untuk staf
        } elseif ($user->role === 'manajer') {
            return redirect()->intended('/berandaStaf'); // Rute untuk manajer
        }

        // Rute default jika peran tidak dikenali
        return redirect()->intended('/beranda'); 
    }

    // Jika login gagal, redirect kembali ke halaman login dengan pesan kesalahan
    return redirect()->back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput();
}

    

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
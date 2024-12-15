<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        // Mengambil semua pengguna yang memiliki role yang sesuai
        if (!in_array(Auth::user()->role, ['admin', 'manajer', 'staf'])) {
            abort(403, 'Unauthorized action.');
        }

        // Mengambil data pengguna dari tabel users
        $penggunaakuns = User::where('role', 'user')->get(); // Sesuaikan dengan role yang Anda butuhkan

        // Mengirim data pengguna ke view
        return view('penggunaakun', compact('penggunaakuns'));
    }

    // Menambahkan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        // Membuat pengguna baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('penggunaakun.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }
}

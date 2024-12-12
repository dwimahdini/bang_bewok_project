<?php

namespace App\Http\Controllers;

use App\Models\PenggunaAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PenggunaAkunController extends Controller
{
    public function index()
    {
            // Periksa apakah role pengguna adalah 'admin' atau 'manajer'
    if (Auth::user()->role != 'admin') {
        abort(404); // Tampilkan halaman 404 jika role tidak sesuai
    }
        $penggunaakuns = PenggunaAkun::all();
        return view('penggunaakun', compact('penggunaakuns'));
    }

    public function store(Request $request)
    {
        // Log::info($request->all());
        // dd($request->all()); // Hapus atau komentari baris ini setelah debugging
        $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string',
            'cabang' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
            'notel' => 'required|string|max:20',
            'email' => 'required|email|unique:penggunaakun,email',
        ]);

        $penggunaAkun = new PenggunaAkun($request->all());
        $penggunaAkun->password = bcrypt($request->password);

        $penggunaAkun->save();

        return redirect()->route('penggunaakun.index')->with('success', 'Pengguna Akun berhasil ditambahkan.');
    }
}

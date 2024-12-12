<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabangController extends Controller
{
    public function index()
    {

    if (Auth::user()->role != 'admin') {
        abort(404); 
    }
        $cabangs = Cabang::all();
        return view('cabang', compact('cabangs'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'jalan' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'kota' => 'required|string|max:255',
        'nomor_telepon' => 'required|string|max:15',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        // Logika penyimpanan gambar
        $imagePath = $request->file('image_path')->store('images', 'public');

        // Membuat entri baru di tabel Cabang
        Cabang::create([
            'nama' => $request->nama,
            'jalan' => $request->jalan,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'nomor_telepon' => $request->nomor_telepon,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('cabang.index')->with('success', 'Cabang baru berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menambahkan cabang: ' . $e->getMessage());
    }
}

}

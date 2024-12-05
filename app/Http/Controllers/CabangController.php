<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $cabangs = Cabang::all();
        return view('cabang', compact('cabangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jalan' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image_path')->store('images', 'public');

        Cabang::create([
            'nama' => $request->nama,
            'jalan' => $request->jalan,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'nomor_telepon' => $request->nomor_telepon,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('cabang.index')->with('success', 'Cabang baru berhasil ditambahkan.');
    }
}

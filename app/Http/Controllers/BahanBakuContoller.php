<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuContoller extends Controller
{
    public function index(){
        $bahan = BahanBaku::all();
        return view('inventory',['tampil' => $bahan]);
    }

    public function create(){
        return view('tambahInventory');
    }

    public function store(Request $request){

        $request->validate([
            'namaProduk' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]); 

        $bahan = BahanBaku::create($request->all());

       if($request->hasFile('gambar')){
        $filename = $request->namaProduk . '.'. now()->timestamp. '.' . $request->file('gambar')->getClientOriginalExtension();
        $request -> file('gambar')->move('img/', $filename);
        $bahan->gambar = $filename;
        $bahan->save();
       }
       
        return redirect('/inventory')->with('success', 'Data berhasil ditambahkan!');
    }

    public function delete($id){
        $bahan = BahanBaku::findOrFail($id);
        $bahan->delete();
        return redirect('/inventory');
    }

    public function edit($id)
{
    $bahan = BahanBaku::findOrFail($id);
    return view('editInventory', compact('bahan'));
}

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'namaProduk' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Temukan bahan baku berdasarkan ID
    $bahan = BahanBaku::findOrFail($id);

    // Perbarui atribut dengan input dari form
    $bahan->namaProduk = $request->input('namaProduk');
    $bahan->jumlah = $request->input('jumlah');
    $bahan->satuan = $request->input('satuan');
    $bahan->harga = $request->input('harga');
    $bahan->tanggal_kadaluarsa = $request->input('tanggal_kadaluarsa');
    $bahan->status = $request->input('status');

    // Jika ada gambar yang diupload, proses gambar baru
    if ($request->hasFile('gambar')) {
        $filename = $request->namaProduk . '.' . now()->timestamp . '.' . $request->file('gambar')->getClientOriginalExtension();
        $request->file('gambar')->move('img/', $filename);
        $bahan->gambar = $filename;
    }

    // Simpan perubahan
    $bahan->save();

    return redirect('/inventory')->with('success', 'Data bahan baku berhasil diperbarui!');
}


}
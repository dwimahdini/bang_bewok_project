<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;

class KeranjangController extends Controller
{
    protected $keranjang = [];

    public function addToCart(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil produk berdasarkan ID
        $produk = Produk::find($request->product_id);

        // Hitung total harga
        $total = $produk->harga * $request->quantity;

        // Simpan pesanan ke database
        Pesanan::create([
            'produk_id' => $produk->id,
            'jumlah' => $request->quantity,
            'harga' => $produk->harga,
            'total' => $total,
        ]);

        // Tambahkan produk ke keranjang (session)
        $this->keranjang[] = [
            'id' => $produk->id,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
            'jumlah' => $request->quantity,
            'total' => $total,
        ];

        // Simpan keranjang ke session
        session(['keranjang' => $this->keranjang]);

        return redirect()->route('keranjangStaf.view')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        // Ambil semua pesanan dari database
        $pesanan = Pesanan::with('produk')->get();

        return view('keranjangStaf', compact('pesanan'));
    }
} 
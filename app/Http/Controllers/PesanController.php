<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    /**
     * Display a list of products for ordering.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->role != 'staf') {
            abort(404); // Tampilkan halaman 404 jika role tidak sesuai
        }
        $produk = Produk::all();

        // Convert tanggal_kadaluarsa to Carbon instances
        $produk->transform(function ($p) {
            $p->tanggal_kadaluarsa = Carbon::parse($p->tanggal_kadaluarsa);
            return $p;
        });

        return view('pesan', ['produk' => $produk]);
    }

    public function tambahKeKeranjang(Request $request)
    {
        $productId = $request->input('product_id');
        $jumlahDipesan = $request->input('quantity');

        // Cari produk berdasarkan ID
        $produk = Produk::find($productId);

        if ($produk && $produk->jumlah >= $jumlahDipesan) {
            // Kurangi jumlah produk
            $produk->jumlah -= $jumlahDipesan;
            $produk->save();

            // Simpan pesanan ke database
            $pesanan = new Pesanan();
            $pesanan->produk_id = $productId;
            $pesanan->jumlah = $jumlahDipesan;
            $pesanan->harga = $produk->harga;
            $pesanan->total = $produk->harga * $jumlahDipesan;
            $pesanan->save();

            return redirect()->route('keranjangStaf')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        } else {
            return redirect()->back()->with('error', 'Jumlah produk tidak mencukupi.');
        }
    }

    public function tampilkanKeranjang()
    {
        $pesanan = Pesanan::with('produk')->get(); // Pastikan relasi 'produk' ada di model Pesanan
        return view('keranjangStaf', ['pesanan' => $pesanan]);
    }
}

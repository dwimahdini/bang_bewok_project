<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananMasuk;
use Illuminate\Support\Facades\DB;

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

    public function deleteFromCart($id)
    {
        DB::transaction(function () use ($id) {
            $pesanan = Pesanan::findOrFail($id);
            $produk = $pesanan->produk;

            $produk->jumlah += $pesanan->jumlah;
            $produk->save();

            $pesanan->delete();
        });

        return redirect()->route('keranjangStaf.view')->with('success', 'Produk berhasil dihapus dari keranjang dan stok diperbarui!');
    }

    public function prosesPesanan()
    {
        $pesanan = Pesanan::with('produk')->get();

        foreach ($pesanan as $item) {
            PesananMasuk::create([
                'produk_id' => $item->produk_id,
                'jumlah' => $item->jumlah,
                'harga' => $item->harga,
                'total' => $item->total,
            ]);
        }

        // Hapus semua pesanan saat ini
        Pesanan::truncate();

        // Redirect ke halaman pesananMasuk.view
        return redirect()->route('pesananMasuk.view')->with('success', 'Pesanan berhasil diproses!');
    }
} 
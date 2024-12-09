<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PenggunaAkunController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PesananMasukController;

// Route untuk mengambil produk di database lalu ditampilkan
Route::get('/inventori', [ProdukController::class, 'index'])->name('produk.index');
// Route untuk menyimpan produk ke database
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
// Route untuk mengedit produk
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
// Route menghapus produk
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');


// ROUTE UNTUK STAFF
Route::get('/staf', [StaffController::class, 'index']);
Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staf', [StaffController::class, 'index'])->name('staff.index');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');

// ROUTE UNTUK CABANG
Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index');
Route::post('/cabangs', [CabangController::class, 'store'])->name('cabangs.store');

// ROUTE UNTUK PESANAN MASUK
Route::get('/pesananMasuk', [PesanController::class, 'index'])->name('pesananMasuk.view');
Route::get('/pesananMasuk', [PesananMasukController::class, 'index'])->name('pesananMasuk.view');

// ROUTE UNTUK TABLE MENAMPUNG AKUN
Route::get('/penggunaakun', [PenggunaAkunController::class, 'index'])->name('penggunaakun.index');
Route::post('/penggunaakun', [PenggunaAkunController::class, 'store'])->name('penggunaakun.store');

// ROUTE UNTUK KERANJANG
Route::get('/keranjangStaf', [KeranjangController::class, 'viewCart'])->name('keranjangStaf.view');
Route::post('/tambah-ke-keranjang', [PesanController::class, 'tambahKeKeranjang'])->name('tambahKeKeranjang');
Route::delete('/keranjangStaf/{id}', [KeranjangController::class, 'deleteFromCart'])->name('keranjangStaf.delete');
Route::post('/keranjangStaf/proses', [KeranjangController::class, 'prosesPesanan'])->name('keranjangStaf.proses');
Route::post('/keranjangStaf', [KeranjangController::class, 'addToCart'])->name('keranjangStaf');

Route::get('/', function () { return view('welcome');});

Route::get('/pesananMasuk', function () { return view('pesananMasuk');});

Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');   

Route::get('/beranda', function () { return view('beranda');});

Route::get('/login', [LoginController::class, 'showLoginForm']);

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PesanController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
//use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaAkunController;
//use App\Http\Controllers\PesananMasukController;
use App\Http\Controllers\PesanProdukController;
use App\Http\Controllers\KeranjangPesananController;

// ROUTE UNTUK INVENTORI
Route::get('/inventori', [ProdukController::class, 'index'])->name('inventori')->middleware('auth');
// Route untuk mengambil produk di database lalu ditampilkan
Route::get('/inventori', [ProdukController::class, 'index'])->name('produk.index')->middleware('auth');
// Route untuk menyimpan produk ke database
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store')->middleware('auth');
// Route untuk mengedit produk
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update')->middleware('auth');
// Route menghapus produk
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy')->middleware('auth');
Route::get('/inventori', [ProdukController::class, 'index'])->name('inventori')->middleware('auth');

Route::get('/inventori', [ProdukController::class, 'index'])->name('inventori')->middleware('auth');


// ROUTE UNTUK STAFF
Route::get('/staf', [StaffController::class, 'index'])->middleware('auth');
Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store')->middleware('auth');
Route::get('/staf', [StaffController::class, 'index'])->name('staff.index')->middleware('auth');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy')->middleware('auth');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit')->middleware('auth');
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update')->middleware('auth');

// ROUTE UNTUK CABANG
Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index')->middleware('auth');
Route::post('/cabangs', [CabangController::class, 'store'])->name('cabangs.store')->middleware('auth');
Route::delete('/cabangs/{id}', [CabangController::class, 'destroy'])->name('cabangs.destroy')->middleware('auth');
Route::get('/cabangs', [CabangController::class, 'index'])->name('cabangs.index');

// ROUTE UNTUK PESANAN MASUK
//Route::get('/pesananMasuk', [PesanController::class, 'index'])->name('pesananMasuk.view')->middleware('auth');
//Route::get('/pesananMasuk', [PesananMasukController::class, 'index'])->name('pesananMasuk.view')->middleware('auth');
//Route::get('/pesananMasuk', function () { return view('pesananMasuk');})->middleware('auth');
//Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index')->middleware('auth');   

// ROUTE UNTUK TABLE MENAMPUNG AKUN
Route::get('/penggunaakun', [PenggunaAkunController::class, 'index'])->name('penggunaakun.index')->middleware('auth');
Route::post('/penggunaakun', [PenggunaAkunController::class, 'store'])->name('penggunaakun.store')->middleware('auth');

// ROUTE UNTUK KERANJANG
//Route::get('/keranjangStaf', [KeranjangController::class, 'viewCart'])->name('keranjangStaf.view')->middleware('auth');
//Route::post('/tambah-ke-keranjang', [PesanController::class, 'tambahKeKeranjang'])->name('tambahKeKeranjang')->middleware('auth');
//Route::delete('/keranjangStaf/{id}', [KeranjangController::class, 'deleteFromCart'])->name('keranjangStaf.delete')->middleware('auth');
//Route::post('/keranjangStaf/proses', [KeranjangController::class, 'prosesPesanan'])->name('keranjangStaf.proses')->middleware('auth');
//Route::post('/keranjangStaf', [KeranjangController::class, 'addToCart'])->name('keranjangStaf')->middleware('auth');

// ROUTE UNTUK LANDING PAGE
Route::get('/', function () { return view('welcome');});

// ROUTE UNTUK BERANDA
Route::get('/beranda', [ProdukController::class, 'berandaAdmin'])->name('beranda')->middleware('auth');

//beranda staf
Route::get('/berandaStaf', function () { return view('berandaStaf');})->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'autentic']);
Route::get('/login', function () { return view('login');});

//laporan
Route::get('/laporan', [LaporanController::class,'index']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

//landing page
Route::get('/', function () { return view('welcome');});

Route::resource('produk', ProdukController::class);

// ROUTE UNTUK LAPORAN
Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store')->middleware('auth');

// Route untuk menyimpan pengguna baru
Route::post('/users/store', [PenggunaAkunController::class, 'store'])->name('users.store');

// ROUTE UNTUK PENGGUNA AKUN
Route::get('/penggunaakun', [PenggunaAkunController::class, 'index']);


// ROUTE BARU UNTUK PESAN PRODUK
Route::get('/pesanProduk', [PesanProdukController::class, 'index'])->name('pesan.produk')->middleware('auth');

// Route untuk menambahkan produk ke keranjang
Route::post('/keranjang', [KeranjangPesananController::class, 'addToCart'])->name('keranjang.add')->middleware('auth');

// Route untuk melihat keranjang
Route::get('/keranjangPesanan', [KeranjangPesananController::class, 'viewCart'])->name('keranjang.view')->middleware('auth');

Route::post('/produk/batal/{id}', [ProdukController::class, 'batal'])->name('produk.batal');

Route::post('/keranjangPesanan', [ProdukController::class, 'tambahKeKeranjang']);

Route::post('/keranjangPesanan', [KeranjangPesananController::class, 'store'])->name('keranjang.store')->middleware('auth');
Route::patch('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update')->middleware('auth');
Route::patch('/produk/{id}/update', [ProdukController::class, 'update']);

Route::delete('/keranjang/{id}/batal', [KeranjangPesananController::class, 'batalPesanan']);


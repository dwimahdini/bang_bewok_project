@extends('layouts.sidebar')
@section('title', 'Keranjang Pesanan')
@vite('resources/css/app.css')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Keranjang Pesanan</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($keranjang as $item)
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-lg font-semibold">Produk ID: {{ $item->produk_id }}</h2>
            <p class="text-gray-600">Jumlah: {{ $item->jumlah }}</p>
            <!-- Tambahkan informasi produk lainnya jika diperlukan -->
        </div>
        @endforeach
    </div>
</div>
@endsection
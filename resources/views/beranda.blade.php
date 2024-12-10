@extends('layouts.sidebar')
@section('title', 'Beranda')

@section('content')
<div class="p-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('inventori') }}" class="bg-green-300 p-4 rounded-lg shadow-md text-center hover:bg-green-400 transition duration-300">
            <h2 class="text-4xl">{{ $produkTersedia }}</h2>
            <p class="text-gray-800">Produk Tersedia</p>
        </a>
        <a href="{{ route('inventori') }}" class="bg-yellow-300 p-4 rounded-lg shadow-md text-center hover:bg-yellow-400 transition duration-300">
            <h2 class="text-4xl">{{ $produkMenipis }}</h2>
            <p class="text-gray-800">Produk Menipis</p>
        </a>
        <a href="{{ route('inventori') }}" class="bg-red-300 p-4 rounded-lg shadow-md text-center hover:bg-red-400 transition duration-300">
            <h2 class="text-4xl">{{ $produkTidakTersedia }}</h2>
            <p class="text-gray-800">Produk Tidak Tersedia</p>
        </a>
    </div>
</div>

<style>
    /* Menggunakan font Inter */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
    }
</style>
@endsection
@extends('layouts.sidebar')
@section('title', 'Beranda')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Status Produk</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Available Products Card -->
        <div class="bg-green-500 text-white p-8 rounded-lg shadow-md text-center">
            <img src="path/to/available-icon.png" alt="Available" class="mx-auto mb-4 w-12 h-12">
            <p class="text-xl font-semibold mt-2">TERSEDIA</p>
        </div>

        <!-- Running Low Products Card -->
        <div class="bg-yellow-500 text-white p-8 rounded-lg shadow-md text-center">
            <img src="path/to/running-low-icon.png" alt="Running Low" class="mx-auto mb-4 w-12 h-12">
            <p class="text-xl font-semibold mt-2">MENIPIS</p>
        </div>

        <!-- Unavailable Products Card -->
        <div class="bg-red-500 text-white p-8 rounded-lg shadow-md text-center">
            <img src="path/to/unavailable-icon.png" alt="Unavailable" class="mx-auto mb-4 w-12 h-12">
            <p class="text-xl font-semibold mt-2">TIDAK TERSEDIA</p>
        </div>
    </div>
</div>
@endsection

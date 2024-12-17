@extends('layouts.sidebar')
@section('title', 'Keranjang Staf')
@vite('resources/css/app.css')

@section('content')
    <form action="{{ route('laporan.store') }}" method="POST" class="max-w-md mx-auto mt-8">
        @csrf
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Laporan:</label>
            <input type="date" id="tanggal" name="tanggal" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>
        <button type="submit" class="w-full bg-green-500 text-white font-bold py-2 rounded hover:bg-green-600">Simpan</button>
    </form>
@endsection
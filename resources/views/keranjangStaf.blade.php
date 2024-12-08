@extends('layouts.sidebar')
@section('title', 'Keranjang Staf')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <!-- Frame untuk Keranjang -->
    <div id="frameKeranjang" class="bg-white p-4 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Daftar Pesanan</h1>

        @if(count($pesanan) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                    <thead style="background-color: #C3AB12;">
                        <tr>
                            <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama Produk</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Jumlah</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Harga</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pesanan as $index => $item)
                        <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                            <td class="px-4 py-2 text-center text-xs text-gray-900 border-r border-gray-300">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-center text-xs text-gray-900 border-r border-gray-300">{{ $item->produk->nama_produk }}</td>
                            <td class="px-4 py-2 text-center text-xs text-gray-900 border-r border-gray-300">{{ $item->jumlah }}</td>
                            <td class="px-4 py-2 text-right text-xs text-gray-900 border-r border-gray-300">{{ number_format($item->harga, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 text-right text-xs text-gray-900">{{ number_format($item->total, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Harga and Proses Pesanan in Horizontal Table -->
            <div class="mt-4">
                <table class="min-w-full bg-gray-100 shadow-md rounded-lg border border-gray-300">
                    <tr>
                        <td class="px-4 py-2 text-left text-xs font-medium text-gray-900">Total Harga</td>
                        <td class="px-4 py-2 text-right text-xs font-medium text-gray-900">Rp {{ number_format($pesanan->sum('total'), 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-right">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Proses Pesanan</button>
                        </td>
                    </tr>
                </table>
            </div>
        @else
            <p class="text-gray-700">Tidak ada pesanan.</p>
        @endif
    </div>
</div>
@endsection

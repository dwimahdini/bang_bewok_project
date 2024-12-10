@extends('layouts.sidebar')
@section('title', 'Pesan')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <!-- Frame untuk Produk -->
    <div id="frameProduk" class="bg-white p-4 rounded-lg shadow-sm">

        <!-- Fitur Search -->
        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            <input 
                type="text" 
                id="searchInput" 
                onkeyup="searchTable()" 
                placeholder="Cari Produk" 
                class="flex-grow border border-gray-300 px-4 py-2 text-lg rounded-lg focus:outline-none transition duration-300">
        </div>

        <!-- Kartu Produk -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($produk as $p)
            <div class="bg-gray-50 rounded-lg shadow-md p-2 hover:shadow-lg transition duration-300 border border-gray-300">
                <div class="flex flex-col items-center">
                    @if($p->gambar)
                        <img src="{{ asset('storage/' . $p->gambar) }}" alt="Gambar Produk" class="w-24 h-24 object-cover rounded-lg mb-2">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Gambar Produk" class="w-24 h-24 object-cover rounded-lg mb-2">
                    @endif
                    <h2 class="text-lg font-bold mb-2 text-center">{{ $p->nama_produk }}</h2>
                    <p class="text-sm text-gray-600 mb-2">Jumlah: {{ $p->jumlah }}</p>
                    <p class="text-sm text-gray-600 mb-2">Harga: {{ number_format($p->harga, 2, ',', '.') }}</p>
                    <p class="text-sm text-gray-600 mb-2">Satuan: {{ $p->satuan }}</p>
                    <p class="text-sm text-gray-600 mb-2">Tanggal Kedaluarsa: {{ $p->tanggal_kadaluarsa->format('Y-m-d') }}</p>
                    <span class="px-2 py-1 rounded shadow mb-2"
                        style="
                            @if($p->status_kedaluarsa == 'aman') background-color: #d4edda; color: #155724;
                            @elseif($p->status_kedaluarsa == 'mendekati') background-color: #fff3cd; color: #856404;
                            @else background-color: #f8d7da; color: #721c24;
                            @endif">
                        {{ ucfirst($p->status_kedaluarsa) }}
                    </span>
                    <button onclick="openOrderModal('{{ $p->id }}', '{{ $p->nama_produk }}', '{{ $p->harga }}', '{{ $p->satuan }}', '{{ $p->jumlah }}', '{{ $p->tanggal_kadaluarsa->format('Y-m-d') }}')" class="border border-gray-300 px-3 py-1.5 rounded-lg bg-white text-gray-800 hover:bg-gray-100 transition duration-300">
                        <i class='bx bx-basket'></i> Pesan
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal Pesan -->
<div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center" tabindex="-1" aria-hidden="true">
    <div class="bg-white rounded-lg p-4 w-full max-w-3xl flex flex-col shadow-lg transition-transform transform scale-95 hover:scale-100">
        <h2 class="text-xl font-bold mb-4 text-center">Pesan Produk</h2>
        <form id="orderForm" method="POST" action="{{ route('tambahKeKeranjang') }}">
            @csrf
            <input type="hidden" name="product_id" id="product_id">
            <div class="mb-4">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" id="product_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" readonly>
            </div>
            <div class="mb-4">
                <label for="product_price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="text" id="product_price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" readonly>
            </div>
            <div class="mb-4">
                <label for="product_unit" class="block text-sm font-medium text-gray-700">Satuan/Berat</label>
                <input type="text" id="product_unit" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" readonly>
            </div>
            <div class="mb-4">
                <label for="available_quantity" class="block text-sm font-medium text-gray-700">Jumlah Tersedia</label>
                <input type="text" id="available_quantity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" readonly>
            </div>
            <div class="mb-4">
                <label for="expiry_date" class="block text-sm font-medium text-gray-700">Tanggal Kedaluarsa</label>
                <input type="text" id="expiry_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" readonly>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah yang Dipesan</label>
                <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" min="1" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeOrderModal()" class="mr-2 bg-red-500 text-white px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-[#5D5108] text-white px-4 py-2 rounded-lg hover:bg-[#C3AB12] transition duration-300">
                    Tambah ke Keranjang
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

<script>
    function openOrderModal(productId, productName, productPrice, productUnit, availableQuantity, expiryDate) {
        document.getElementById('product_id').value = productId;
        document.getElementById('product_name').value = productName;
        document.getElementById('product_price').value = productPrice;
        document.getElementById('product_unit').value = productUnit;
        document.getElementById('available_quantity').value = availableQuantity;
        document.getElementById('expiry_date').value = expiryDate;
        document.getElementById('orderModal').classList.remove('hidden');
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    // Fungsi Pencarian
    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const cards = document.querySelectorAll("#frameProduk .grid > div");
        cards.forEach(card => {
            const name = card.querySelector("h2")?.innerText.toLowerCase() || '';
            card.style.display = name.includes(input) ? '' : 'none';
        });
    }
</script>

@extends('layouts.sidebar')
@section('title', 'Pesan Produk')
@vite('resources/css/app.css')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Pesan Produk</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        @foreach($produk as $p)
        @php
            $currentDate = \Carbon\Carbon::now();
            $expiryDate = \Carbon\Carbon::parse($p->tanggal_kadaluarsa);
            $daysRemaining = $expiryDate->diffInDays($currentDate);

            // Tentukan status kedaluwarsa
            if ($daysRemaining < 0) {
                $statusKedalursa = 'Kedaluwarsa';
            } elseif ($daysRemaining <= 3) {
                $statusKedalursa = 'Mendekati';
            } else {
                $statusKedalursa = 'Aman';
            }
        @endphp
        <div class="bg-white rounded-lg shadow-md p-2 flex flex-col min-h-64">
            <img src="{{ asset('img/' . $p->gambar) }}" alt="Gambar Produk" class="w-full h-50 object-cover rounded-lg mb-2">
            <h2 class="text-lg font-semibold">{{ $p->nama_produk }}</h2>
            <p class="text-gray-600">Harga: Rp {{ number_format($p->harga, 2, ',', '.') }}</p>
            <p class="text-gray-600">Jumlah: {{ $p->jumlah }}</p>
            <p class="text-gray-600">Tanggal Kadaluwarsa: {{ $expiryDate->format('Y-m-d') }}</p>
            <p class="text-gray-600">
                <span class="font-bold {{ $statusKedalursa == 'Kedaluwarsa' ? 'text-red-500' : ($statusKedalursa == 'Mendekati' ? 'text-yellow-500' : 'text-green-500') }}">
                    {{ $statusKedalursa }}
                </span>
            </p>
            <div class="mt-auto">
                <button onclick="openOrderModal({{ $p->id }}, '{{ $p->nama_produk }}', {{ $p->harga }})" class="mt-2 bg-[#5D5108] text-white px-2 py-1 rounded-lg">Pesan</button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Pesan Produk -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden" tabindex="-1" aria-hidden="true">
    <div class="bg-white rounded-lg p-4 w-full max-w-md" role="dialog" aria-labelledby="orderTitle" aria-modal="true">
        <h2 class="text-lg font-semibold mb-2 text-center" id="orderTitle">Pesan Produk</h2>
        <div id="orderContent">
            <p id="productName"></p>
            <p id="productPrice"></p>
            <label for="quantity" class="block mt-2">Jumlah:</label>
            <input type="number" id="quantity" class="border border-gray-300 rounded-lg w-full p-2" min="1" value="1">
        </div>
        <div class="flex justify-between mt-4">
            <button type="button" onclick="closeOrderModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</button>
            <button type="button" onclick="confirmOrder()" class="bg-green-500 text-white px-4 py-2 rounded-lg">Pesan</button>
        </div>
    </div>
</div>

<script>
    let selectedProductId;

    function openOrderModal(productId, productName, productPrice) {
        selectedProductId = productId;
        document.getElementById("productName").innerText = `Nama Produk: ${productName}`;
        document.getElementById("productPrice").innerText = `Harga: Rp ${productPrice.toLocaleString()}`;
        document.getElementById("orderModal").classList.remove("hidden");
    }

    function closeOrderModal() {
        document.getElementById("orderModal").classList.add("hidden");
    }

    function confirmOrder() {
        const quantity = document.getElementById("quantity").value;

        fetch('/keranjang', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan untuk menyertakan token CSRF
            },
            body: JSON.stringify({
                productId: selectedProductId,
                quantity: quantity
            })
        })
        .then(response => {
            if (response.ok) {
                console.log(`Pesan ${quantity} dari produk ID: ${selectedProductId}`);
                closeOrderModal();
                // Mungkin Anda ingin memperbarui tampilan keranjang di sini
            } else {
                console.error('Gagal menambahkan produk ke keranjang');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection
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
            $statusKedalursa = $daysRemaining < 0 ? 'Kedaluwarsa' : ($daysRemaining <= 3 ? 'Mendekati' : 'Aman');
        @endphp
        <div class="bg-white rounded-lg shadow-md p-2 flex flex-col min-h-64">
            <img src="{{ asset('img/' . $p->gambar) }}" alt="Gambar Produk" class="w-full h-50 object-cover rounded-lg mb-2">
            <h2 class="text-lg font-semibold">{{ $p->nama_produk }}</h2>
            <p class="text-gray-600">Harga: Rp {{ number_format($p->harga, 2, ',', '.') }}</p>
            <p id="product-quantity-{{ $p->id }}" class="text-gray-600">Jumlah: {{ $p->jumlah }}</p>
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
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-4 w-full max-w-md">
        <h2 class="text-lg font-semibold mb-2 text-center">Pesan Produk</h2>
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

    // Fungsi untuk membuka modal
    function openOrderModal(productId, productName, productPrice) {
        selectedProductId = productId;
        document.getElementById("productName").innerText = `Nama Produk: ${productName}`;
        document.getElementById("productPrice").innerText = `Harga: Rp ${productPrice.toLocaleString()}`;
        document.getElementById("orderModal").classList.remove("hidden");
    }

    // Fungsi untuk menutup modal
    function closeOrderModal() {
        document.getElementById("orderModal").classList.add("hidden");
    }

    // Fungsi untuk mengkonfirmasi pesanan
    async function confirmOrder() {
        const quantity = document.getElementById("quantity").value;

        try {
            // Kirim data ke server
            const response = await fetch('/keranjang', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    productId: selectedProductId,
                    quantity: quantity
                })
            });

            if (response.ok) {
                console.log("Produk berhasil ditambahkan ke keranjang");

                // Perbarui jumlah stok produk
                const updateResponse = await fetch(`/produk/${selectedProductId}/update`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: -quantity
                    })
                });

                if (updateResponse.ok) {
                    console.log(`Pesan ${quantity} dari produk ID: ${selectedProductId}`);
                    
                    // Perbarui tampilan jumlah produk
                    const productElement = document.getElementById(`product-quantity-${selectedProductId}`);
                    if (productElement) {
                        const currentQuantityText = productElement.innerText; // "Jumlah: 5"
                        const currentQuantity = parseInt(currentQuantityText.split(': ')[1]); // Ambil angka setelah ": "
                        
                        // Pastikan currentQuantity adalah angka sebelum mengurangi
                        if (!isNaN(currentQuantity)) {
                            productElement.innerText = `Jumlah: ${currentQuantity - quantity}`; // Update jumlah produk di tampilan
                        } else {
                            console.error('Jumlah produk tidak valid:', currentQuantityText);
                        }
                    }

                    closeOrderModal();
                } else {
                    const errorData = await updateResponse.json();
                    console.error('Gagal mengupdate jumlah produk:', errorData.message);
                }
            } else {
                console.error('Gagal menambahkan produk ke keranjang');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
</script>
@endsection
@extends('layouts.sidebar')
@section('title', 'Pesan')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <!-- Frame untuk Produk -->
    <div id="frameProduk" class="bg-white p-4 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        <!-- Fitur Sort, Search, Tambah -->
        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            <select id="sortCriteria" class="border border-gray-300 px-3 py-1.5 text-sm rounded-lg focus:outline-none transition duration-300" onchange="sortTable()">
                <option value="" disabled selected>Urutkan</option>
                <option value="nama_produk">Abjad</option>
                <option value="status_kedaluarsa">Status Kedaluarsa</option>
            </select>
            <input 
                type="text" 
                id="searchInput" 
                onkeyup="searchTable()" 
                placeholder="Cari Produk" 
                class="flex-grow border border-gray-300 px-3 py-1.5 text-sm rounded-lg focus:outline-none transition duration-300">
        </div>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                <thead style="background-color: #C3AB12;">
                    <tr>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Gambar</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama Produk</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Jumlah</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Harga</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Satuan/Berat</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Tanggal kedaluarsa</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Status kedaluarsa</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider">Pesan</th>
                    </tr>
                </thead>
                <tbody id="productTable" class="bg-white divide-y divide-gray-200">
                    @foreach($produk as $p)
                    <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">
                            @if($p->gambar)
                                <img src="{{ asset('storage/' . $p->gambar) }}" alt="Gambar Produk" class="w-10 h-10 object-cover rounded-full">
                            @else
                                <img src="https://via.placeholder.com/50" alt="Gambar Produk" class="w-10 h-10 object-cover rounded-full">
                            @endif
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 border-r border-gray-300">{{ $p->nama_produk }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $p->jumlah }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-right border-r border-gray-300">{{ number_format($p->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $p->satuan }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $p->tanggal_kadaluarsa->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">
                            <span class="px-2 py-1 rounded shadow"
                                style="
                                    @if($p->status_kedaluarsa == 'aman') background-color: #d4edda; color: #155724;
                                    @elseif($p->status_kedaluarsa == 'mendekati') background-color: #fff3cd; color: #856404;
                                    @else background-color: #f8d7da; color: #721c24;
                                    @endif">
                                {{ ucfirst($p->status_kedaluarsa) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center">
                            <button onclick="openOrderModal('{{ $p->id }}', '{{ $p->nama_produk }}', '{{ $p->harga }}', '{{ $p->satuan }}', '{{ $p->jumlah }}', '{{ $p->tanggal_kadaluarsa->format('Y-m-d') }}')" class="border border-gray-300 px-2 py-1 rounded-lg hover:bg-gray-100 transition duration-300">
                                <i class='bx bx-basket'></i>
                            </button>
                        </td>                    
                    </tr>                
                    @endforeach
                </tbody>            
            </table>
        </div>
    </div>
</div>

<!-- Modal Pesan -->
<div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-md mx-4">
        <h2 class="text-xl font-bold mb-4">Pesan Produk</h2>
        <form id="orderForm" method="POST" action="{{ route('tambahKeKeranjang') }}">
            @csrf
            <input type="hidden" name="product_id" id="product_id">
            <div class="mb-4">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" id="product_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" readonly>
            </div>
            <div class="mb-4">
                <label for="product_price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="text" id="product_price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" readonly>
            </div>
            <div class="mb-4">
                <label for="product_unit" class="block text-sm font-medium text-gray-700">Satuan/Berat</label>
                <input type="text" id="product_unit" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" readonly>
            </div>
            <div class="mb-4">
                <label for="available_quantity" class="block text-sm font-medium text-gray-700">Jumlah Tersedia</label>
                <input type="text" id="available_quantity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" readonly>
            </div>
            <div class="mb-4">
                <label for="expiry_date" class="block text-sm font-medium text-gray-700">Tanggal Kedaluarsa</label>
                <input type="text" id="expiry_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" readonly>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah yang Dipesan</label>
                <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" min="1" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeOrderModal()" class="mr-2 bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Tambah ke Keranjang</button>
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

    // Fungsi Sort
    function sortTable() {
        const table = document.getElementById("productTable");
        const rows = Array.from(table.rows);
        const criteria = document.getElementById("sortCriteria").value;

        if (!criteria) return; // Tidak melakukan apapun jika tidak ada kriteria yang dipilih

        rows.sort((a, b) => {
            let valueA, valueB;

            switch (criteria) {
                case 'nama_produk':
                    valueA = a.cells[2].innerText.toLowerCase();
                    valueB = b.cells[2].innerText.toLowerCase();
                    return valueA.localeCompare(valueB);
                case 'status_kedaluarsa':
                    valueA = a.cells[7].innerText.toLowerCase();
                    valueB = b.cells[7].innerText.toLowerCase();
                    const expiryOrder = ['aman', 'mendekati', 'kedaluarsa'];
                    return expiryOrder.indexOf(valueA) - expiryOrder.indexOf(valueB);
                default:
                    return 0;
            }
        });

        rows.forEach((row, index) => {
            table.appendChild(row);
            row.cells[0].innerText = index + 1; // Menetapkan ulang nomor
        });
    }

    // Fungsi Pencarian
    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#productTable tr");
        rows.forEach(row => {
            const name = row.cells[2]?.innerText.toLowerCase() || '';
            row.style.display = name.includes(input) ? '' : 'none';
        });
    }
</script>

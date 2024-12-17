@extends('layouts.sidebar')
@section('title', 'Inventori')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <div id="frameProduk" class="bg-white p-4 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            <select id="sortCriteria" class="border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300" onchange="sortTable()">
                <option value="" disabled selected>Urutkan</option>
                <option value="nama_produk">Abjad</option>
                <option value="status_tersedia">Status Ketersediaan</option>
                <option value="status_kedaluarsa">Status Kedaluarsa</option>
            </select>

            <input 
                type="text" 
                id="searchInput" 
                onkeyup="searchTable()" 
                placeholder="Cari Produk" 
                class="flex-grow border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300">

            <button onclick="openAddModal()" class="border border-gray-300 px-4 py-2 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'">
                Tambah Produk
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                <thead style="background-color: #C3AB12;">
                    <tr>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Gambar</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama Produk</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Jumlah</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Harga (Rp)</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Satuan/Berat</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Tanggal kedaluarsa</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Status kedaluarsa</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Status Ketersediaan</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody id="productTable" class="bg-white divide-y divide-gray-200">
                    @foreach($produk as $p)
                    @php
                        $currentDate = \Carbon\Carbon::now();
                        $expiryDate = \Carbon\Carbon::parse($p->tanggal_kadaluarsa);
                        $daysRemaining = $expiryDate->diffInDays($currentDate);

                        // Tentukan status kedalursa
                        if ($daysRemaining < 0) {
                            $statusKedalursa = 'kedaluarsa';
                        } elseif ($daysRemaining <= 3) {
                            $statusKedalursa = 'mendekati';
                        } else {
                            $statusKedalursa = 'aman';
                        }

                        // Tentukan status ketersediaan
                        if ($p->jumlah < 2) {
                            $statusKetersediaan = 'menipis';
                        } else {
                            $statusKetersediaan = 'tersedia';
                        }
                    @endphp
                    <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">
                            @if($p->gambar)
                                <img src="{{ asset('img/' . $p->gambar) }}" alt="Gambar Produk" class="w-24 h-24 object-cover rounded-lg mb-2">
                            @else
                                <img src="https://via.placeholder.com/50" alt="Gambar Produk" class="w-10 h-10 object-cover rounded-full">
                            @endif
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 border-r border-gray-300">{{ $p->nama_produk }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">{{ $p->jumlah }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-right border-r border-gray-300">{{ number_format($p->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">{{ $p->satuan }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">
                            {{ $expiryDate->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">
                            <span class="px-1 py-0.5 text-xs rounded shadow"
                                style="
                                    @if($statusKedalursa == 'aman') background-color: #d4edda; color: #155724;
                                    @elseif($statusKedalursa == 'mendekati') background-color: #fff3cd; color: #856404;
                                    @else background-color: #f8d7da; color: #721c24;
                                    @endif">
                                {{ ucfirst($statusKedalursa) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">
                            <span class="px-1 py-0.5 text-xs rounded shadow"
                                style="
                                    @if($statusKetersediaan == 'tersedia') background-color: #d4edda; color: #155724;
                                    @elseif($statusKetersediaan == 'menipis') background-color: #fff3cd; color: #856404;
                                    @else background-color: #f8d7da; color: #721c24;
                                    @endif">
                                {{ ucfirst($statusKetersediaan) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">
                            <button onclick="openEditModal({{ $p->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                            <button onclick="deleteProduct({{ $p->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                        </td>
                    </tr>                
                    @endforeach
                </tbody>            
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden" tabindex="-1" aria-hidden="true">
    <div class="bg-white rounded-lg p-4 w-full max-w-md">
        <h2 class="text-lg font-semibold mb-2 text-center">Tambah Produk</h2>
        <form id="addForm" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nama_produk" class="block text-sm font-medium mb-1">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="jumlah" class="block text-sm font-medium mb-1">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required min="0">
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium mb-1">Harga</label>
                <input type="number" id="harga" name="harga" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required min="0.01" step="0.01">
            </div>
            <div class="mb-4">
                <label for="satuan" class="block text-sm font-medium mb-1">Satuan/Berat</label>
                <input type="text" id="satuan" name="satuan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="tanggal_kadaluarsa" class="block text-sm font-medium mb-1">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium mb-1">Gambar Produk</label>
                <input type="file" id="gambar" name="gambar" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" accept="image/*" required>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeAddModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-[#5D5108] text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Sort function
    function sortTable() {
        const table = document.getElementById("productTable");
        const rows = Array.from(table.rows);
        const criteria = document.getElementById("sortCriteria").value;

        if (!criteria) return; // Do nothing if no valid criteria is selected

        rows.sort((a, b) => {
            let valueA, valueB;

            switch (criteria) {
                case 'nama_produk':
                    valueA = a.cells[2].innerText.toLowerCase();
                    valueB = b.cells[2].innerText.toLowerCase();
                    return valueA.localeCompare(valueB);
                case 'status_tersedia':
                    valueA = a.cells[8].innerText.toLowerCase();
                    valueB = b.cells[8].innerText.toLowerCase();
                    const statusOrder = ['tersedia', 'menipis', 'tidak tersedia'];
                    return statusOrder.indexOf(valueA) - statusOrder.indexOf(valueB);
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
            row.cells[0].innerText = index + 1; // Reassign the number
        });
    }

    // Search function
    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#productTable tr");
        rows.forEach(row => {
            const name = row.cells[2]?.innerText.toLowerCase() || '';
            row.style.display = name.includes(input) ? '' : 'none';
        });
    }

    // Function to open add modal
    function openAddModal() {
        document.getElementById("addModal").classList.remove("hidden");
    }

    // Function to close add modal
    function closeAddModal() {
        document.getElementById("addModal").classList.add("hidden");
    }
</script>
@endsection
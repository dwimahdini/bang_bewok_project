@extends('layouts.sidebar')
@section('title', 'Inventori')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <!-- Frame untuk Produk -->
    <div id="frameProduk" class="bg-white p-4 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

        <!-- Fitur Sort, Search, Tambah -->
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

        @if(Auth::user()->role === 'admin') <!-- Pemeriksaan peran admin -->
        <button onclick="openModal()" class="border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'">
            Tambah Produk
        </button>
    @endif
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
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Harga (Rp)</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Satuan/Berat</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Tanggal kedaluarsa</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Status kedaluarsa</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Status Ketersediaan</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="productTable" class="bg-white divide-y divide-gray-200">
                    @foreach($produk as $p)
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
                            @if($p->tanggal_kadaluarsa instanceof \Carbon\Carbon)
                                {{ $p->tanggal_kadaluarsa->format('Y-m-d') }}
                            @else
                                {{ $p->tanggal_kadaluarsa }}
                            @endif
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">
                            <span class="px-1 py-0.5 text-xs rounded shadow"
                                style="
                                    @if($p->status_kedaluarsa == 'aman') background-color: #d4edda; color: #155724;
                                    @elseif($p->status_kedaluarsa == 'mendekati') background-color: #fff3cd; color: #856404;
                                    @else background-color: #f8d7da; color: #721c24;
                                    @endif">
                                {{ ucfirst($p->status_kedaluarsa) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center border-r border-gray-300">
                            <span class="px-1 py-0.5 text-xs rounded shadow"
                                style="
                                    @if($p->status_tersedia == 'tersedia') background-color: #d4edda; color: #155724;
                                    @elseif($p->status_tersedia == 'menipis') background-color: #fff3cd; color: #856404;
                                    @else background-color: #f8d7da; color: #721c24;
                                    @endif">
                                {{ ucfirst($p->status_tersedia) }}
                            </span>
                        </td>

                        @if(Auth::user()->role === 'admin')
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                            <button class="bg-yellow-400 text-white px-2 py-1 rounded-lg hover:bg-yellow-500 transition duration-300" 
                                    onclick="openEditModal(this)" 
                                    data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nama_produk }}"
                                    data-jumlah="{{ $p->jumlah }}"
                                    data-harga="{{ $p->harga }}"
                                    data-satuan="{{ $p->satuan }}"
                                    data-tanggal="{{ $p->tanggal_kadaluarsa->format('Y-m-d') }}">
                                Edit
                            </button>
                            @endif

                            @if(Auth::user()->role === 'admin')
                            <form action="{{ route('produk.destroy', $p->id) }}" method="POST" class="inline-block" data-id="{{ $p->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="openDeleteModal({{ $p->id }})" class="bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition duration-300">
                                    Hapus
                                </button>
                                @endif
                            </form>
                        </td>                    
                    </tr>                
                    @endforeach
                </tbody>            
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto hidden" tabindex="-1" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-auto">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="bg-white rounded-lg p-4 w-full max-w-2xl flex flex-col shadow-lg transition-transform transform scale-95 hover:scale-100">
                    <!-- Bagian Kiri: Preview Gambar -->
                    <div class="flex-1 mb-4 relative">
                        <h2 class="text-lg font-semibold mb-2 text-center">Tambah Produk Baru</h2>
                        <div 
                            id="gambarProdukContainer" 
                            class="border border-gray-300 rounded-lg px-4 py-2 flex justify-center items-center h-32 bg-gray-50 hover:bg-gray-100 transition duration-300 cursor-pointer"
                            ondragover="allowDrop(event)"
                            ondrop="dropImage(event)"
                            onclick="document.getElementById('gambarProduk').click()"
                        >
                            <input 
                                type="file" 
                                id="gambarProduk" 
                                name="gambar"
                                accept="img/*" 
                                class="hidden"
                                onchange="previewImage()"
                            >
                            <p id="dropText" class="text-gray-500">Drag & Drop Gambar di sini atau klik untuk memilih</p>
                            <img id="imagePreview" class="mt-2 hidden max-w-full h-auto object-contain" alt="Pratinjau Gambar">
                        </div>
                    </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="namaProduk" class="block text-sm font-medium mb-1">Nama Produk</label>
                        <input type="text" id="namaProduk" name="nama_produk" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required autocomplete="off">
                    </div>
                    <div>
                        <label for="jumlahProduk" class="block text-sm font-medium mb-1">Jumlah</label>
                        <input type="number" id="jumlahProduk" name="jumlah" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required min="0" autocomplete="off">
                    </div>
                    <div>
                        <label for="hargaProduk" class="block text-sm font-medium mb-1">Harga</label>
                        <input type="number" id="hargaProduk" name="harga" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required min="0.01" step="0.01" autocomplete="off">
                    </div>
                    <div>
                        <label for="satuanProduk" class="block text-sm font-medium mb-1">Satuan/Berat</label>
                        <input type="text" id="satuanProduk" name="satuan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required autocomplete="off">
                    </div>
                    <div>
                        <label for="kadaluarsaProduk" class="block text-sm font-medium mb-1">Tanggal Kadaluarsa</label>
                        <input type="date" id="kadaluarsaProduk" name="tanggal_kadaluarsa" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required autocomplete="off">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300 mr-2">Batal</button>
                    <button type="submit" class="bg-[#5D5108] text-white px-4 py-2 rounded-lg hover:bg-[#C3AB12] transition duration-300">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden" tabindex="-1" aria-hidden="true">
    <div class="bg-white rounded-lg p-4 w-full max-w-2xl flex flex-col shadow-lg transition-transform transform scale-95 hover:scale-100">
        <!-- Bagian Kiri: Preview Gambar -->
        <div class="flex-1 mb-4 relative">
            <h2 class="text-lg font-semibold mb-2 text-center">Edit Produk</h2>
            <div 
                id="editGambarProdukContainer" 
                class="border border-gray-300 rounded-lg px-4 py-2 flex justify-center items-center h-32 bg-gray-50 hover:bg-gray-100 transition duration-300 cursor-pointer"
                ondragover="allowDrop(event)"
                ondrop="dropImage(event)"
                onclick="document.getElementById('editGambarProduk').click()"
            >
                <input 
                    type="file" 
                    id="editGambarProduk" 
                    accept="image/*" 
                    class="hidden"
                    onchange="previewEditImage()"
                >
                <p id="editDropText" class="text-gray-500">Drag & Drop Gambar di sini atau klik untuk memilih</p>
                <img id="editImagePreview" class="mt-2 hidden max-w-full h-auto object-contain" alt="Pratinjau Gambar">
            </div>
        </div>

        <!-- Bagian Kanan: Formulir Input -->
        <div class="flex-1">
            <form id="editForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="editNamaProduk" class="block text-sm font-medium mb-1">Nama Produk</label>
                        <input type="text" id="editNamaProduk" name="nama_produk" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                    </div>
                    <div>
                        <label for="editJumlahProduk" class="block text-sm font-medium mb-1">Jumlah</label>
                        <input type="number" id="editJumlahProduk" name="jumlah" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required min="0">
                    </div>
                    <div>
                        <label for="editHargaProduk" class="block text-sm font-medium mb-1">Harga</label>
                        <input type="number" id="editHargaProduk" name="harga" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required min="0.01" step="0.01">
                    </div>
                    <div>
                        <label for="editSatuanProduk" class="block text-sm font-medium mb-1">Satuan/Berat</label>
                        <input type="text" id="editSatuanProduk" name="satuan" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                    </div>
                    <div>
                        <label for="editKadaluarsaProduk" class="block text-sm font-medium mb-1">Tanggal Kadaluarsa</label>
                        <input type="date" id="editKadaluarsaProduk" name="tanggal_kadaluarsa" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeEditModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300 mr-2">Batal</button>
                    <button type="submit" class="bg-[#5D5108] text-white px-4 py-2 rounded-lg hover:bg-[#C3AB12] transition duration-300">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden" tabindex="-1" aria-hidden="true">
    <div class="bg-white rounded-lg p-4 w-full max-w-md flex flex-col">
        <h2 class="text-lg font-semibold mb-4 text-center">Konfirmasi Hapus</h2>
        <p class="text-center">Apakah Anda yakin ingin menghapus produk ini?</p>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeDeleteModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300 mr-2">Batal</button>
            <button id="confirmDeleteButton" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">Hapus</button>
        </div>
    </div>
</div>
@endsection

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function allowDrop(event) {
        event.preventDefault();
    }

    function dropImage(event) {
        event.preventDefault();
        const fileInput = document.getElementById('gambarProduk');
        const droppedFile = event.dataTransfer.files[0];

        if (droppedFile && droppedFile.type.startsWith('image/')) {
            fileInput.files = event.dataTransfer.files;
            displayImagePreview(droppedFile);
        } else {
            alert('Hanya file gambar yang diizinkan.');
        }
    }

    function displayImagePreview(file, isEditModal = false) {
        const preview = isEditModal 
            ? document.getElementById('editImagePreview') 
            : document.getElementById('imagePreview');
        const dropText = isEditModal 
            ? document.getElementById('editDropText') 
            : document.getElementById('dropText');
        const container = isEditModal
            ? document.getElementById('editGambarProdukContainer')
            : document.getElementById('gambarProdukContainer');

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            dropText.classList.add('hidden');
            
            // Maintain container size
            preview.style.maxWidth = '100%';
            preview.style.maxHeight = '100%';
            preview.style.objectFit = 'contain';

            // Ensure container keeps its original dimensions
            container.style.height = '8rem'; // Tailwind's h-32 is equivalent to 8rem
            container.style.display = 'flex';
            container.style.justifyContent = 'center';
            container.style.alignItems = 'center';
        };

        reader.readAsDataURL(file);
    }

    // Open modal
    function openModal() {
        document.getElementById("modal").classList.remove("hidden");
    }

    // Close modal
    function closeModal() {
        document.getElementById("modal").classList.add("hidden");
        document.getElementById('gambarProduk').value = ''; // Reset file input
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('dropText').classList.remove('hidden');
    }

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

    // Open edit modal and populate form
    function openEditModal(button) {
        const id = button.getAttribute('data-id');
        const form = document.getElementById('editForm');
        form.action = `/produk/${id}`;

        document.getElementById('editNamaProduk').value = button.getAttribute('data-nama');
        document.getElementById('editJumlahProduk').value = button.getAttribute('data-jumlah');
        document.getElementById('editHargaProduk').value = button.getAttribute('data-harga');
        document.getElementById('editSatuanProduk').value = button.getAttribute('data-satuan');
        document.getElementById('editKadaluarsaProduk').value = button.getAttribute('data-tanggal');

        document.getElementById("editModal").classList.remove("hidden");
    }

    // Close edit modal
    function closeEditModal() {
        document.getElementById("editModal").classList.add("hidden");
    }

    let deleteProductId;

    function openDeleteModal(productId) {
        deleteProductId = productId; // Simpan ID produk yang akan dihapus
        document.getElementById("deleteModal").classList.remove("hidden");
    }

    function closeDeleteModal() {
        document.getElementById("deleteModal").classList.add("hidden");
    }

    window.onload = function() {
        document.getElementById("confirmDeleteButton").addEventListener("click", function() {
            const form = document.querySelector(`form[data-id='${deleteProductId}']`);
            if (form) {
                form.submit(); // Kirim formulir untuk menghapus produk
            }
            closeDeleteModal(); // Tutup modal
        });
    };

    function validateForm() {
        const jumlah = document.getElementById('editJumlahProduk').value;
        if (jumlah < 0) {
            alert('Jumlah tidak boleh kurang dari 0');
            return false;
        }
        return true;
    }

    // Update the existing functions to pass the edit modal flag
    function previewImage() {
        const fileInput = document.getElementById('gambarProduk');
        const file = fileInput.files[0];

        if (file && file.type.startsWith('image/')) {
            displayImagePreview(file, false);
        } else {
            alert('Hanya file gambar yang diizinkan.');
        }
    }

    // Add a similar function for edit modal
    function previewEditImage() {
        const fileInput = document.getElementById('editGambarProduk');
        const file = fileInput.files[0];

        if (file && file.type.startsWith('image/')) {
            displayImagePreview(file, true);
        } else {
            alert('Hanya file gambar yang diizinkan.');
        }
    }
</script>
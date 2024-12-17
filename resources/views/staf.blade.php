@extends('layouts.sidebar')
@section('title', 'Staf')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <!-- Frame untuk Staf -->
    <div id="frameStaf" class="bg-white p-4 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Daftar Staf</h1>

        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            <select id="sortCriteria" class="border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300" onchange="sortTable()">
                <option value="" disabled selected>Urutkan</option>
                <option value="nama">Nama</option>
                <option value="posisi">Posisi</option>
            </select>

            <input 
                type="text" 
                id="searchInput" 
                onkeyup="searchTable()" 
                placeholder="Cari Staf" 
                class="flex-grow border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300">

            <button onclick="openAddStaffModal()" class="border border-gray-300 px-4 py-2 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'">
                Tambah Staf
            </button>
        </div>

        <!-- Tabel Staf -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300 table-auto w-full">
                <thead style="background-color: #C3AB12;">
                    <tr>
                        <th class="px-6 py-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nomor Telepon</th>
                        <th class="px-6 py-4 text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Email</th>
                        <th class="px-6 py-4 text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Posisi</th>
                        <th class="px-6 py-4 text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Cabang</th>
                        <th class="px-6 py-4 text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="staffTable" class="bg-white divide-y divide-gray-200">
                    @foreach($staffs as $staff)
                    <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 border-r border-gray-300">{{ $staff->nama }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $staff->notel }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 border-r border-gray-300">{{ $staff->email }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $staff->posisi }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $staff->cabang }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center">
                            <button class="bg-yellow-400 text-white px-2 py-1 rounded-lg hover:bg-yellow-500 transition duration-300" 
                                    onclick="openEditModal(this)" 
                                    data-id="{{ $staff->id }}"
                                    data-nama="{{ $staff->nama }}"
                                    data-notel="{{ $staff->notel }}"
                                    data-email="{{ $staff->email }}"
                                    data-posisi="{{ $staff->posisi }}"
                                    data-cabang="{{ $staff->cabang }}">
                                Edit
                            </button>
                            <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition duration-300" 
                                        onclick="return confirm('Yakin ingin menghapus staf ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>                    
                    </tr>                
                    @endforeach
                </tbody>            
            </table>
        </div>
    </div>
</div>

<!-- Add Staff Modal -->
<div id="addStaffModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-lg font-semibold mb-4">Tambah Staf Baru</h2>
        <form action="{{ route('staff.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium mb-2">Nama</label>
                <input type="text" id="nama" name="nama" autocomplete="off" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="notel" class="block text-sm font-medium mb-2">Nomor Telepon</label>
                <input type="text" id="notel" name="notel" autocomplete="off" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" autocomplete="off" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="posisi" class="block text-sm font-medium mb-2">Posisi</label>
                <select id="posisi" name="posisi" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                    <option value="staf">Staf</option>
                    <option value="kepala cabang">Kepala Cabang</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="cabang" class="block text-sm font-medium mb-2">Cabang</label>
                <select id="cabang" name="cabang" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                    <option value="" disabled selected>Pilihan Cabang</option>
                    @foreach($cabangs as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeAddStaffModal()" class="bg-gray-500 text-white px-3 py-2 rounded-lg hover:bg-gray-600 transition duration-300 mr-2">Batal</button>
                <button type="submit" class="border border-gray-300 px-3 py-2 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Staff Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Staf</h2>
        <form id="editForm" action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="editNama" class="block text-sm font-medium mb-2">Nama</label>
                <input type="text" id="editNama" name="nama" autocomplete="off" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="editNotel" class="block text-sm font-medium mb-2">Nomor Telepon</label>
                <input type="text" id="editNotel" name="notel" autocomplete="off" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="editEmail" class="block text-sm font-medium mb-2">Email</label>
                <input type="email" id="editEmail" name="email" autocomplete="off" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="editPosisi" class="block text-sm font-medium mb-2">Posisi</label>
                <select id="editPosisi" name="posisi" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                    <option value="staf">Staf</option>
                    <option value="kepala cabang">Kepala Cabang</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="editCabang" class="block text-sm font-medium mb-2">Cabang</label>
                <select id="editCabang" name="cabang" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                    <option value="" disabled selected>Pilihan Cabang</option>
                    @foreach($cabangs as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" border border-gray-300 px-4 py-2 text-xs rounded-lg focus:outline-none transition duration-300">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Add JavaScript functions for sorting and searching similar to the inventory page
    function sortTable() {
        const table = document.getElementById("staffTable");
        const rows = Array.from(table.rows);
        const criteria = document.getElementById("sortCriteria").value;

        if (!criteria) return;

        rows.sort((a, b) => {
            let valueA, valueB;

            switch (criteria) {
                case 'nama':
                    valueA = a.cells[1].innerText.toLowerCase();
                    valueB = b.cells[1].innerText.toLowerCase();
                    return valueA.localeCompare(valueB);
                case 'posisi':
                    valueA = a.cells[4].innerText.toLowerCase();
                    valueB = b.cells[4].innerText.toLowerCase();
                    const positionOrder = ['kepala cabang', 'staf'];
                    return positionOrder.indexOf(valueA) - positionOrder.indexOf(valueB);
                default:
                    return 0;
            }
        });

        // Re-append sorted rows and update numbering
        rows.forEach((row, index) => {
            table.appendChild(row);
            row.cells[0].innerText = index + 1; // Update the numbering
        });
    }

    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#staffTable tr");
        rows.forEach(row => {
            const name = row.cells[1]?.innerText.toLowerCase() || '';
            row.style.display = name.includes(input) ? '' : 'none';
        });
    }

    function openAddStaffModal() {
        document.getElementById("addStaffModal").classList.remove("hidden");
    }

    function closeAddStaffModal() {
        document.getElementById("addStaffModal").classList.add("hidden");
    }

    function openEditModal(button) {
        const id = button.getAttribute('data-id');
        const form = document.getElementById('editForm');
        form.action = `/staff/${id}`;

        document.getElementById('editNama').value = button.getAttribute('data-nama');
        document.getElementById('editNotel').value = button.getAttribute('data-notel');
        document.getElementById('editEmail').value = button.getAttribute('data-email');
        document.getElementById('editPosisi').value = button.getAttribute('data-posisi');
        document.getElementById('editCabang').value = button.getAttribute('data-cabang');

        document.getElementById("editModal").classList.remove("hidden");
    }

    function closeEditModal() {
        document.getElementById("editModal").classList.add("hidden");
    }
</script>
@endsection
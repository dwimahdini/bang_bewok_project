@extends('layouts.sidebar')
@section('title', 'Pengguna Akun')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <div id="framePenggunaAkun" class="bg-white p-4 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Daftar Pengguna Akun</h1>

        <!-- Fitur Sort, Search, Tambah -->
        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            <select id="sortCriteria" class="border border-gray-300 px-3 py-1.5 text-sm rounded-lg focus:outline-none transition duration-300" onchange="sortTable()">
                <option value="" disabled selected>Urutkan</option>
                <option value="nama">Nama</option>
                <option value="posisi">Posisi</option>
                <option value="cabang">Cabang</option>
            </select>
            <input 
                type="text" 
                id="searchInput" 
                onkeyup="searchTable()" 
                placeholder="Cari Pengguna" 
                class="flex-grow border border-gray-300 px-3 py-1.5 text-sm rounded-lg focus:outline-none transition duration-300">
            <button onclick="openModal()" class="border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'"">
                Tambah Pengguna
            </button>
        </div>

        <!-- Tabel Pengguna Akun -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                <thead style="background-color: #C3AB12;">
                    <tr>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Posisi</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Cabang</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No Tel</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Email</th>
                    </tr>
                </thead>
                <tbody id="userTable" class="bg-white divide-y divide-gray-200">
                    @foreach($penggunaakuns as $index => $penggunaAkun)
                    <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $penggunaAkun->nama }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $penggunaAkun->posisi }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $penggunaAkun->cabang }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">{{ $penggunaAkun->notel }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center">{{ $penggunaAkun->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden" tabindex="-1" aria-hidden="true">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Tambah Pengguna Baru</h2>
        <form action="{{ route('penggunaakun.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="nama" class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" id="nama" name="nama" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                </div>
                <div>
                    <label for="posisi" class="block text-sm font-medium mb-1">Posisi</label>
                    <select id="posisi" name="posisi" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" onchange="toggleCabangDropdown()" required>
                        <option value="" disabled selected>Pilih Posisi</option>
                        <option value="manajer">Manajer</option>
                        <option value="kepala cabang">Kepala Cabang</option>
                        <option value="staf">Staf</option>
                    </select>
                </div>
                <div id="cabangContainer" class="hidden">
                    <label for="cabang" class="block text-sm font-medium mb-1">Cabang</label>
                    <select id="cabang" name="cabang" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300">
                        <option value="" disabled selected>Pilih Cabang</option>
                        <option value="cabang 1">Cabang 1</option>
                        <option value="cabang 2">Cabang 2</option>
                        <option value="cabang 3">Cabang 3</option>
                    </select>
                </div>
                <div>
                    <label for="notel" class="block text-sm font-medium mb-1">No Tel</label>
                    <input type="text" id="notel" name="notel" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                        <span onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            <svg id="password-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7zm0 12c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                        <span onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            <svg id="password_confirmation-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7zm0 12c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300 mr-2">Batal</button>
                <button type="submit" class="border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("modal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("modal").classList.add("hidden");
    }

    function toggleCabangDropdown() {
        const posisi = document.getElementById("posisi").value;
        const cabangContainer = document.getElementById("cabangContainer");
        if (posisi === "kepala cabang" || posisi === "staf") {
            cabangContainer.classList.remove("hidden");
        } else {
            cabangContainer.classList.add("hidden");
        }
    }

    function togglePasswordVisibility(id) {
        const input = document.getElementById(id);
        const eyeIcon = document.getElementById(`${id}-eye`);
        if (input.type === "password") {
            input.type = "text";
            eyeIcon.setAttribute("d", "M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7zm0 12c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z");
        } else {
            input.type = "password";
            eyeIcon.setAttribute("d", "M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7zm0 12c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z");
        }
    }

    function sortTable() {
        const table = document.getElementById("userTable");
        const rows = Array.from(table.rows);
        const criteria = document.getElementById("sortCriteria").value;

        if (!criteria) return; // Do nothing if no valid criteria is selected

        rows.sort((a, b) => {
            let valueA, valueB;

            switch (criteria) {
                case 'nama':
                    valueA = a.cells[1].innerText.toLowerCase();
                    valueB = b.cells[1].innerText.toLowerCase();
                    return valueA.localeCompare(valueB);
                case 'posisi':
                    valueA = a.cells[2].innerText.toLowerCase();
                    valueB = b.cells[2].innerText.toLowerCase();
                    return valueA.localeCompare(valueB);
                case 'cabang':
                    valueA = a.cells[3].innerText.toLowerCase();
                    valueB = b.cells[3].innerText.toLowerCase();
                    return valueA.localeCompare(valueB);
                default:
                    return 0;
            }
        });

        rows.forEach((row, index) => {
            table.appendChild(row);
            row.cells[0].innerText = index + 1; // Reassign the number
        });
    }

    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#userTable tr");
        rows.forEach(row => {
            const name = row.cells[1]?.innerText.toLowerCase() || '';
            row.style.display = name.includes(input) ? '' : 'none';
        });
    }
</script>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection

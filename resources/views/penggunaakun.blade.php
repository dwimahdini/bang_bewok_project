@extends('layouts.sidebar')
@section('title', 'Pengguna Akun')
@vite('resources/css/app.css')

@section('content')
    <div class="p-1 md:p-1 font-inter">
        <h1 class="text-2xl font-bold mb-4">Daftar Pengguna</h1>

        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            <input 
                type="text" 
                id="searchInput" 
                onkeyup="searchTable()" 
                placeholder="Cari Pengguna" 
                class="flex-grow border border-gray-300 px-5 py-2 text-sm rounded-lg focus:outline-none transition duration-300">

            <button onclick="openAddModal()" class="border border-gray-300 px-4 py-2 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'">
                Tambah Pengguna
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                <thead style="background-color: #C3AB12;">
                    <tr>
                        <th class="py-2 px-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama</th>
                        <th class="py-2 px-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Email</th>
                        <th class="py-2 px-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Tanggal Bergabung</th>
                        <th class="py-2 px-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Status</th>
                        <th class="py-2 px-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Role</th>
                        <th class="py-2 px-4 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Password (Hash)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                            <td class="py-2 px-4 border-b text-gray-900">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b text-gray-900">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b text-gray-900">{{ $user->created_at ? $user->created_at->format('d-m-Y') : 'Tidak Diketahui' }}</td>
                            <td class="py-2 px-4 border-b text-gray-900">{{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td class="py-2 px-4 border-b text-gray-900">{{ $user->role ?? 'Tidak Diketahui' }}</td>
                            <td class="py-2 px-4 border-b text-gray-900">
                                <span class="relative">
                                    <input type="text" id="password-{{ $user->id }}" value="{{ $user->password }}" class="border border-gray-300 rounded p-1 w-30" readonly>
                                    <button type="button" onclick="togglePasswordVisibility('password-{{ $user->id }}')" class="absolute right-11/2 top-1/2 transform -translate-y-1/2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12a9 9 0 0118 0 9 9 0 01-18 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden" tabindex="-1" aria-hidden="true">
        <div class="bg-white rounded-lg p-4 w-full max-w-md">
            <h2 class="text-lg font-semibold mb-2 text-center">Tambah Pengguna</h2>
            <form id="addForm" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium mb-1">Role</label>
                    <select id="role" name="role" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none transition duration-300" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="staf">Staf</option>
                        <option value="admin">Admin</option>
                        <option value="manajer">Manajer</option>
                    </select>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeAddModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="bg-[#5D5108] text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const passwordInput = document.getElementById(id);
            if (passwordInput.type === "text") {
                passwordInput.type = "password";
            } else {
                passwordInput.type = "text";
            }
        }

        function searchTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                const name = row.cells[0]?.innerText.toLowerCase() || '';
                row.style.display = name.includes(input) ? '' : 'none';
            });
        }

        function openAddModal() {
            document.getElementById("addModal").classList.remove("hidden");
        }

        function closeAddModal() {
            document.getElementById("addModal").classList.add("hidden");
        }
    </script>
@endsection

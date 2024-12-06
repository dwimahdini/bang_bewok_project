@extends('layouts.sidebar')

@section('title', 'Pengelolaan')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <!-- Frame untuk Pengelolaan -->
    <div id="framePengelolaan" class="bg-white p-4 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Daftar Pengelolaan</h1>

        <!-- Fitur Sort, Search, Tambah -->
        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            <select id="sortCriteriaPengelolaan" class="border border-gray-300 px-3 py-1.5 text-sm rounded-lg focus:outline-none transition duration-300" onchange="sortTablePengelolaan()">
                <option value="" disabled selected>Urutkan</option>
                <option value="nama">Nama</option>
                <option value="posisi">Posisi</option>
            </select>
            <input 
                type="text" 
                id="searchInputPengelolaan" 
                onkeyup="searchTablePengelolaan()" 
                placeholder="Cari Pengelolaan" 
                class="flex-grow border border-gray-300 px-3 py-1.5 text-sm rounded-lg focus:outline-none transition duration-300">
            <button onclick="openAddPengelolaanModal()" class="border border-gray-300 px-3 py-1.5 text-sm rounded-lg focus:outline-none transition duration-300" style="background-color: #5D5108; color: white;" onmouseover="this.style.backgroundColor='#C3AB12'" onmouseout="this.style.backgroundColor='#5D5108'">
                Tambah Pengelolaan
            </button>
        </div>

        <!-- Tabel Pengelolaan -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                <thead style="background-color: #C3AB12;">
                    <tr>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Posisi</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pengelolaanTable" class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">1</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 border-r border-gray-300">John Doe</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center border-r border-gray-300">Staf</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900 text-center">
                            <button class="bg-yellow-400 text-white px-2 py-1 rounded-lg hover:bg-yellow-500 transition duration-300" 
                                    onclick="openEditPengelolaanModal(this)" 
                                    data-id="1"
                                    data-nama="John Doe"
                                    data-posisi="Staf">
                                Edit
                            </button>
                            <button class="bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition duration-300" 
                                    onclick="return confirm('Yakin ingin menghapus pengelolaan ini?')">
                                Hapus
                            </button>
                        </td>                    
                    </tr>
                    <!-- Add more static rows as needed -->
                </tbody>            
            </table>
        </div>
    </div>
</div>

<!-- Add Pengelolaan Modal -->
<div id="addPengelolaanModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
        <h2 class="text-xl font-semibold mb-4">Tambah Pengelolaan Baru</h2>
        <form enctype="multipart/form-data">
            <div class="flex">
                <!-- Photo Section -->
                <div class="w-1/3 flex flex-col items-center">
                    <div class="w-32 h-32 bg-gray-200 flex justify-center items-center mb-2">
                        <img id="photoPreview" class="w-full h-full object-cover" src="#" alt="Preview" style="display: none;">
                        <span id="photoPlaceholder" class="text-gray-500">Foto</span>
                    </div>
                    <input type="file" id="photo" name="photo" accept="image/*" class="w-full text-sm" onchange="previewPhoto()">
                </div>
                <!-- Form Section -->
                <div class="w-2/3 pl-4">
                    <div class="mb-4 flex items-center">
                        <label for="posisi" class="block text-sm font-medium mb-2 w-1/3">Posisi</label>
                        <select id="posisi" name="posisi" class="w-2/3 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required onchange="toggleCabangField()">
                            <option value="manajer">Manajer</option>
                            <option value="kepala cabang">Kepala Cabang</option>
                            <option value="staf">Staf</option>
                        </select>
                    </div>
                    <div class="mb-4 flex items-center hidden" id="cabangField">
                        <label for="cabang" class="block text-sm font-medium mb-2 w-1/3">Cabang</label>
                        <select id="cabang" name="cabang" class="w-2/3 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300">
                            <option value="1">Cabang 1</option>
                            <option value="2">Cabang 2</option>
                            <option value="3">Cabang 3</option>
                        </select>
                    </div>
                    <div class="mb-4 flex items-center">
                        <label for="username" class="block text-sm font-medium mb-2 w-1/3">Username</label>
                        <input type="text" id="username" name="username" autocomplete="off" class="w-2/3 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                    </div>
                    <div class="mb-4 flex items-center">
                        <label for="password" class="block text-sm font-medium mb-2 w-1/3">Kata Sandi</label>
                        <div class="w-2/3 flex items-center">
                            <input type="password" id="password" name="password" autocomplete="off" class="flex-grow border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                            <button type="button" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')" class="ml-2 text-sm text-gray-600 hover:text-gray-800 focus:outline-none">
                                <i id="togglePasswordIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-4 flex items-center">
                        <label for="confirmPassword" class="block text-sm font-medium mb-2 w-1/3">Konfirmasi Kata Sandi</label>
                        <div class="w-2/3 flex items-center">
                            <input type="password" id="confirmPassword" name="confirmPassword" autocomplete="off" class="flex-grow border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required oninput="validatePassword()">
                            <button type="button" onclick="togglePasswordVisibility('confirmPassword', 'toggleConfirmPasswordIcon')" class="ml-2 text-sm text-gray-600 hover:text-gray-800 focus:outline-none">
                                <i id="toggleConfirmPasswordIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div id="passwordWarning" class="text-red-500 text-sm mb-4 hidden">Kata sandi dan konfirmasi kata sandi tidak cocok.</div>
                    <div class="mb-4 flex items-center">
                        <label for="nama" class="block text-sm font-medium mb-2 w-1/3">Nama</label>
                        <input type="text" id="nama" name="nama" autocomplete="off" class="w-2/3 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                    </div>
                    <div class="mb-4 flex items-center">
                        <label for="notel" class="block text-sm font-medium mb-2 w-1/3">Nomor Telepon/WA</label>
                        <input type="text" id="notel" name="notel" autocomplete="off" class="w-2/3 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                    </div>
                    <div class="mb-4 flex items-center">
                        <label for="email" class="block text-sm font-medium mb-2 w-1/3">Email</label>
                        <input type="email" id="email" name="email" autocomplete="off" class="w-2/3 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeAddPengelolaanModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300 mr-2">Batal</button>
                <button type="button" onclick="submitForm()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Pengelolaan Modal -->
<div id="editPengelolaanModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Pengelolaan</h2>
        <form id="editPengelolaanForm">
            <div class="mb-4">
                <label for="editNama" class="block text-sm font-medium mb-2">Nama</label>
                <input type="text" id="editNama" name="nama" autocomplete="off" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
            </div>
            <div class="mb-4">
                <label for="editPosisi" class="block text-sm font-medium mb-2">Posisi</label>
                <select id="editPosisi" name="posisi" class="w-full border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none transition duration-300" required>
                    <option value="staf">Staf</option>
                    <option value="kepala cabang">Kepala Cabang</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditPengelolaanModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300 mr-2">Batal</button>
                <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function sortTablePengelolaan() {
        const table = document.getElementById("pengelolaanTable");
        const rows = Array.from(table.rows);
        const criteria = document.getElementById("sortCriteriaPengelolaan").value;

        if (!criteria) return;

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
                    const positionOrder = ['kepala cabang', 'staf'];
                    return positionOrder.indexOf(valueA) - positionOrder.indexOf(valueB);
                default:
                    return 0;
            }
        });

        rows.forEach((row, index) => {
            table.appendChild(row);
            row.cells[0].innerText = index + 1;
        });
    }

    function searchTablePengelolaan() {
        const input = document.getElementById("searchInputPengelolaan").value.toLowerCase();
        const rows = document.querySelectorAll("#pengelolaanTable tr");
        rows.forEach(row => {
            const name = row.cells[1]?.innerText.toLowerCase() || '';
            row.style.display = name.includes(input) ? '' : 'none';
        });
    }

    function toggleCabangField() {
        const posisi = document.getElementById('posisi').value;
        const cabangField = document.getElementById('cabangField');
        if (posisi === 'kepala cabang' || posisi === 'staf') {
            cabangField.classList.remove('hidden');
        } else {
            cabangField.classList.add('hidden');
        }
    }

    function openAddPengelolaanModal() {
        document.getElementById("addPengelolaanModal").classList.remove("hidden");
    }

    function closeAddPengelolaanModal() {
        document.getElementById("addPengelolaanModal").classList.add("hidden");
    }

    function openEditPengelolaanModal(button) {
        const id = button.getAttribute('data-id');
        document.getElementById('editNama').value = button.getAttribute('data-nama');
        document.getElementById('editPosisi').value = button.getAttribute('data-posisi');

        document.getElementById("editPengelolaanModal").classList.remove("hidden");
    }

    function closeEditPengelolaanModal() {
        document.getElementById("editPengelolaanModal").classList.add("hidden");
    }

    function previewPhoto() {
        const file = document.getElementById('photo').files[0];
        const reader = new FileReader();
        const photoPreview = document.getElementById('photoPreview');
        const photoPlaceholder = document.getElementById('photoPlaceholder');

        reader.onloadend = function() {
            photoPreview.src = reader.result;
            photoPreview.style.display = 'block';
            photoPlaceholder.style.display = 'none';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            photoPreview.style.display = 'none';
            photoPlaceholder.style.display = 'block';
        }
    }

    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const passwordWarning = document.getElementById('passwordWarning');
        
        if (password !== confirmPassword) {
            passwordWarning.classList.remove('hidden');
        } else {
            passwordWarning.classList.add('hidden');
        }
    }

    function submitForm() {
        const passwordWarning = document.getElementById('passwordWarning');
        if (passwordWarning.classList.contains('hidden')) {
            alert('Formulir dapat disimpan.');
            // Proceed with form submission or further processing
        } else {
            alert('Periksa kembali kata sandi Anda.');
        }
    }
</script>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
 
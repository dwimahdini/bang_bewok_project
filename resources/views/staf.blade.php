@extends('layouts.sidebar')
@section('title', 'Staf')
@vite('resources/css/app.css')

@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Frame untuk Informasi Staf -->
    <div id="staffCountFrame" class="mb-6 p-4 bg-gray-100 rounded-lg shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">Kepala Cabang</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900"><span id="branchCount">0</span></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">Staf Cabang 1</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900"><span id="branch1StaffCount">0</span></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">Staf Cabang 2</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900"><span id="branch2StaffCount">0</span></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900">Staf Cabang 3</td>
                        <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-900"><span id="branch3StaffCount">0</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Frame untuk Tabel Staf dan Fitur -->
    <div id="stafCabang" class="bg-white p-4 rounded-lg shadow-sm">
        <!-- Fitur Sort, Search, dan Tambah Staf -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-2 md:space-y-0 md:space-x-2">
            <!-- Sort -->
            <button id="sortButton" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Urutkan A-Z
            </button>

            <!-- Search -->
            <input type="text" id="searchInput" placeholder="Cari Nama" class="border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 flex-grow transition duration-300">

            <!-- Tambah Staf -->
            <button id="addStaffButton" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                Tambah Staf
            </button>
        </div>

        <!-- Tabel Staf -->
        <div class="overflow-x-auto">
            <table id="staffTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Telepon</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posisi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($staffs as $staff)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $staff->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $staff->notel }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $staff->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $staff->posisi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $staff->cabang }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                            <button class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 editButton" data-staff='{{ json_encode($staff) }}'>Edit</button>
                            <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus staf ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Staf -->
    <div id="staffModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-11/12 max-w-2xl p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Tambah Staf</h3>
                <button id="closeStaffModal" class="text-gray-500 hover:text-gray-700 transition duration-300">
                    ✖
                </button>
            </div>
            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="staffName" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="staffName" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-300" required>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-4">
                        <label for="staffPhone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="notel" id="staffPhone" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-300" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="staffEmail" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="staffEmail" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-300" required>
                    </div>

                    <!-- Posisi -->
                    <div class="mb-4">
                        <label for="staffPosition" class="block text-sm font-medium text-gray-700">Posisi</label>
                        <select name="posisi" id="staffPosition" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-300" required>
                            <option value="" disabled selected>Pilih Posisi</option>
                            <option value="staf">Staf</option>
                            <option value="kepala cabang">Kepala Cabang</option>
                        </select>
                    </div>

                    <!-- Cabang -->
                    <div class="mb-4" id="branchContainer" style="display: none;">
                        <label for="staffBranch" class="block text-sm font-medium text-gray-700">Cabang</label>
                        <select name="cabang" id="staffBranch" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 transition duration-300">
                            <option value="" disabled selected>Pilih Cabang</option>
                            <option value="cabang 1">Cabang 1</option>
                            <option value="cabang 2">Cabang 2</option>
                            <option value="cabang 3">Cabang 3</option>
                        </select>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end mt-6">
                    <button type="button" id="cancelStaffModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400 transition duration-300">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Staf -->
    <div id="editStaffModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-11/12 max-w-2xl p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Edit Staf</h3>
                <button id="closeEditStaffModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>
            <form id="editStaffForm" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="editStaffName" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="editStaffName" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" required>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-4">
                        <label for="editStaffPhone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="notel" id="editStaffPhone" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="editStaffEmail" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="editStaffEmail" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" required>
                    </div>

                    <!-- Posisi -->
                    <div class="mb-4">
                        <label for="editStaffPosition" class="block text-sm font-medium text-gray-700">Posisi</label>
                        <select name="posisi" id="editStaffPosition" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" required>
                            <option value="" disabled selected>Pilih Posisi</option>
                            <option value="staf">Staf</option>
                            <option value="kepala cabang">Kepala Cabang</option>
                            <option value="manajer">Manajer</option>
                        </select>
                    </div>

                    <!-- Cabang -->
                    <div class="mb-4" id="editBranchContainer" style="display: none;">
                        <label for="editStaffBranch" class="block text-sm font-medium text-gray-700">Cabang</label>
                        <select name="cabang" id="editStaffBranch" class="mt-1 block w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3">
                            <option value="" disabled selected>Pilih Cabang</option>
                            <option value="cabang 1">Cabang 1</option>
                            <option value="cabang 2">Cabang 2</option>
                            <option value="cabang 3">Cabang 3</option>
                        </select>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end mt-6">
                    <button type="button" id="cancelEditStaffModal" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const staffModal = document.getElementById('staffModal');
        const addStaffButton = document.getElementById('addStaffButton');
        const closeStaffModalButton = document.getElementById('closeStaffModal');
        const cancelStaffModalButton = document.getElementById('cancelStaffModal');
        const staffPositionSelect = document.getElementById('staffPosition');
        const branchContainer = document.getElementById('branchContainer');
        const searchInput = document.getElementById('searchInput');
        const sortButton = document.getElementById('sortButton');
        const staffTable = document.getElementById('staffTable').getElementsByTagName('tbody')[0];

        const editStaffModal = document.getElementById('editStaffModal');
        const closeEditStaffModalButton = document.getElementById('closeEditStaffModal');
        const cancelEditStaffModalButton = document.getElementById('cancelEditStaffModal');
        const editStaffForm = document.getElementById('editStaffForm');
        const editStaffName = document.getElementById('editStaffName');
        const editStaffPhone = document.getElementById('editStaffPhone');
        const editStaffEmail = document.getElementById('editStaffEmail');
        const editStaffPosition = document.getElementById('editStaffPosition');
        const editStaffBranch = document.getElementById('editStaffBranch');
        const editBranchContainer = document.getElementById('editBranchContainer');

        const branchCountElement = document.getElementById('branchCount');
        const branch1StaffCountElement = document.getElementById('branch1StaffCount');
        const branch2StaffCountElement = document.getElementById('branch2StaffCount');
        const branch3StaffCountElement = document.getElementById('branch3StaffCount');

        // Modal toggle
        addStaffButton.addEventListener('click', () => staffModal.classList.remove('hidden'));
        closeStaffModalButton.addEventListener('click', () => staffModal.classList.add('hidden'));
        cancelStaffModalButton.addEventListener('click', () => staffModal.classList.add('hidden'));

        // Show/hide branch dropdown based on position selection
        staffPositionSelect.addEventListener('change', function() {
            if (this.value === 'staf' || this.value === 'kepala cabang') {
                branchContainer.style.display = 'block';
                staffBranch.required = true; // Make branch required
            } else {
                branchContainer.style.display = 'none';
                staffBranch.value = ''; // Clear branch value
                staffBranch.required = false; // Make branch not required
            }
        });

        // Search functionality
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            const rows = staffTable.getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                const nameCell = rows[i].getElementsByTagName('td')[1];
                if (nameCell) {
                    const nameValue = nameCell.textContent || nameCell.innerText;
                    rows[i].style.display = nameValue.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                }
            }
        });

        // Sort functionality
        sortButton.addEventListener('click', function() {
            const rows = Array.from(staffTable.getElementsByTagName('tr'));
            rows.sort((a, b) => {
                const nameA = a.getElementsByTagName('td')[1].textContent.toLowerCase();
                const nameB = b.getElementsByTagName('td')[1].textContent.toLowerCase();
                return nameA.localeCompare(nameB);
            });
            rows.forEach((row, index) => {
                row.getElementsByTagName('td')[0].textContent = index + 1; // Update the number column
                staffTable.appendChild(row);
            });
        });

        // Open edit modal and populate data
        document.querySelectorAll('.editButton').forEach(button => {
            button.addEventListener('click', function() {
                const staff = JSON.parse(this.dataset.staff);
                editStaffName.value = staff.nama;
                editStaffPhone.value = staff.notel;
                editStaffEmail.value = staff.email;
                editStaffPosition.value = staff.posisi;
                editStaffBranch.value = staff.cabang;
                editStaffForm.action = `/staff/${staff.id}`;
                editStaffModal.classList.remove('hidden');

                // Show/hide branch dropdown based on position selection
                if (staff.posisi === 'staf' || staff.posisi === 'kepala cabang') {
                    editBranchContainer.style.display = 'block';
                    editStaffBranch.required = true;
                } else {
                    editBranchContainer.style.display = 'none';
                    editStaffBranch.value = ''; // Clear branch value when not needed
                    editStaffBranch.required = false;
                }
            });
        });

        // Modal toggle
        closeEditStaffModalButton.addEventListener('click', () => editStaffModal.classList.add('hidden'));
        cancelEditStaffModalButton.addEventListener('click', () => editStaffModal.classList.add('hidden'));

        // Show/hide branch dropdown based on position selection
        editStaffPosition.addEventListener('change', function() {
            console.log('Position changed to:', this.value); // Debugging
            if (this.value === 'staf' || this.value === 'kepala cabang') {
                editBranchContainer.style.display = 'block';
                editStaffBranch.required = true;
            } else {
                editBranchContainer.style.display = 'none';
                editStaffBranch.value = ''; // Clear branch value when not needed
                editStaffBranch.required = false;
                console.log('Branch value cleared'); // Debugging
            }
        });

        function updateStaffCounts() {
            const rows = staffTable.getElementsByTagName('tr');
            let branch1StaffCount = 0;
            let branch2StaffCount = 0;
            let branch3StaffCount = 0;
            const branches = new Set();

            for (let i = 0; i < rows.length; i++) {
                const positionCell = rows[i].getElementsByTagName('td')[4];
                const branchCell = rows[i].getElementsByTagName('td')[5];
                if (positionCell && branchCell) {
                    const positionValue = positionCell.textContent || positionCell.innerText;
                    const branchValue = branchCell.textContent || branchCell.innerText;

                    if (branchValue) {
                        branches.add(branchValue);
                        if (branchValue === 'cabang 1') {
                            branch1StaffCount++;
                        } else if (branchValue === 'cabang 2') {
                            branch2StaffCount++;
                        } else if (branchValue === 'cabang 3') {
                            branch3StaffCount++;
                        }
                    }
                }
            }

            branchCountElement.textContent = branches.size;
            branch1StaffCountElement.textContent = branch1StaffCount;
            branch2StaffCountElement.textContent = branch2StaffCount;
            branch3StaffCountElement.textContent = branch3StaffCount;
        }

        // Panggil updateStaffCounts saat inisialisasi dan setiap kali tabel dimodifikasi
        updateStaffCounts();

        // Tambahkan event listener untuk memperbarui jumlah saat staf ditambahkan atau dihapus
        // Ini adalah placeholder untuk logika aktual yang akan memicu pembaruan ini
        // Misalnya, setelah pengiriman formulir atau penghapusan berhasil
        // updateStaffCounts();
    });
</script>
@endsection
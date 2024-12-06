@extends('layouts.sidebar')
@section('title', 'Cabang')
@vite('resources/css/app.css')

@section('content')

<div class="flex flex-wrap gap-4">
    @foreach($cabangs as $cabang)
    <div class="max-w-xs border border-gray-200 rounded-lg shadow" style="background-color: white; width: 200px;">
        <a href="#">
            <img class="rounded-t-lg" src="{{ asset($cabang->image_path) }}" alt="{{ $cabang->nama }}" style="height: 100px; width: 100%;" />
        </a>
        <div class="p-2">
            <a href="#">
                <h5 class="mb-1 text-lg font-bold tracking-tight text-black">{{ $cabang->nama }}</h5>
            </a>
            <p class="mb-1 text-sm font-normal text-black">{{ $cabang->jalan }}</p>
            <p class="mb-1 text-sm font-normal text-black">Phone: {{ $cabang->nomor_telepon }}</p>
            <a href="#" class="inline-flex items-center px-2 py-1 text-xs font-medium text-center text-white bg-[#C3AB12] rounded-lg hover:bg-[#5D5108] focus:ring-4 focus:outline-none focus:ring-[#C3AB12]" onclick="openDetailModal('{{ $cabang->nama }}', '{{ asset($cabang->image_path) }}', '{{ $cabang->jalan }}', '{{ $cabang->provinsi }}', '{{ $cabang->kota }}', '{{ $cabang->nomor_telepon }}')">
                Detail
                <svg class="rtl:rotate-180 w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
    @endforeach
    <!-- Card untuk Menambahkan Cabang Baru -->
    <div class="max-w-xs border border-gray-200 rounded-lg shadow p-4" style="background-color: white; width: 200px; cursor: pointer;" onclick="openAddBranchModal()">
        <div class="p-3 flex items-center justify-center h-full text-center">
            <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
            </svg>
            <h5 class="text-lg font-bold text-gray-600">Tambah Cabang Baru</h5>
        </div>
    </div>
</div>

<!-- Modal for Branch Details -->
<div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="p-4 border-b">
                <h3 id="modalBranchName" class="text-lg font-semibold"></h3>
            </div>
            <div class="p-4">
                <img id="modalBranchImage" class="rounded-lg mb-4" src="" alt="" style="width: 100%; height: auto;" />
                <p id="modalBranchAddress" class="mb-2 text-sm font-normal text-black"></p>
                <p id="modalBranchPostalCode" class="mb-2 text-sm font-normal text-black"></p>
                <p id="modalBranchCity" class="mb-2 text-sm font-normal text-black"></p>
                <p id="modalBranchProvince" class="mb-2 text-sm font-normal text-black"></p>
                <p id="modalBranchDistrict" class="mb-2 text-sm font-normal text-black"></p>
                <p id="modalBranchPhone" class="mb-2 text-sm font-normal text-black"></p>
                <div class="flex justify-end">
                    <button type="button" onclick="closeDetailModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Menambahkan Cabang Baru -->
<div id="addBranchModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold">Tambah Cabang Baru</h3>
            </div>
            <div class="p-4">
                <form action="{{ route('cabangs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Cabang</label>
                        <input type="text" name="nama" id="nama" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="jalan" class="block text-sm font-medium text-gray-700">Jalan</label>
                        <input type="text" name="jalan" id="jalan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <input type="text" name="provinsi" id="provinsi" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="kota" class="block text-sm font-medium text-gray-700">Kota</label>
                        <input type="text" name="kota" id="kota" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" id="nomor_telepon" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="image_path" class="block text-sm font-medium text-gray-700">Gambar</label>
                        <input type="file" name="image_path" id="image_path" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeAddBranchModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Batal</button>
                        <button type="submit" class="ml-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openDetailModal(name, image, jalan, provinsi, kota, phone) {
        document.getElementById('modalBranchName').textContent = name;
        document.getElementById('modalBranchImage').src = image;
        document.getElementById('modalBranchAddress').textContent = 'Jalan: ' + jalan;
        document.getElementById('modalBranchCity').textContent = 'Kota: ' + kota;
        document.getElementById('modalBranchProvince').textContent = 'Provinsi: ' + provinsi;
        document.getElementById('modalBranchPhone').textContent = 'Phone: ' + phone;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function openAddBranchModal() {
        document.getElementById('addBranchModal').classList.remove('hidden');
    }

    function closeAddBranchModal() {
        document.getElementById('addBranchModal').classList.add('hidden');
    }
</script>
@endsection
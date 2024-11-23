@extends('layouts.sidebar')

@section('title', 'Tambah Bahan Baku')
@section('content')
@vite('resources/css/app.css')

<div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Bahan Baku</h2>
    <form action="/tambahInventory" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf    
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="col-span-1">
                <label for="gambar" class="block text-lg font-medium text-gray-700">Gambar Produk</label>
                <div id="drop-area" 
                    class="relative flex flex-col items-center justify-center w-full h-56 p-8 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500">
                    <p class="text-gray-500 text-base mb-4" id="drop-text">Seret gambar ke sini atau klik untuk memilih</p>
                    <input type="file" id="gambar" name="gambar" 
                        class="absolute inset-0 opacity-0 cursor-pointer" 
                        accept="image/*">
                    <img id="preview" class="hidden w-40 h-40 object-cover rounded-lg mb-4" alt="Pratinjau Gambar">
                    <button type="button" id="reset-button" 
                            class="hidden px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600 focus:outline-none">
                        Batalkan Gambar
                    </button>
                </div>
            </div>
            <div class="col-span-1">
                <label for="namaProduk" class="block text-lg font-medium text-gray-700">Nama Produk</label>
                <input type="text" id="namaProduk" name="namaProduk" 
                    class="block w-full mt-2 text-lg border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" 
                    placeholder="Masukkan nama produk" required>
            </div>
            <div class="col-span-1">
                <label for="jumlah" class="block text-lg font-medium text-gray-700">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" 
                    class="block w-full mt-2 text-lg border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" 
                    placeholder="Masukkan jumlah" min="1" required>
            </div>
            <div class="col-span-1">
                <label for="satuan" class="block text-lg font-medium text-gray-700">Satuan/Berat</label>
                <input type="text" id="satuan" name="satuan" 
                    class="block w-full mt-2 text-lg border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" 
                    placeholder="Masukkan satuan/berat" required>
            </div>
            <div class="col-span-1">
                <label for="harga" class="block text-lg font-medium text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" 
                    class="block w-full mt-2 text-lg border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" 
                    placeholder="Masukkan harga" min="1" required>
            </div>
            <div class="col-span-1">
                <label for="tanggal_kadaluarsa" class="block text-lg font-medium text-gray-700">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" 
                    class="block w-full mt-2 text-lg border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3" 
                    required>
            </div>
            <div class="col-span-1">
                <label for="status" class="block text-lg font-medium text-gray-700">Status</label>
                <select id="status" name="status" 
                    class="block w-full mt-2 text-lg border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3">
                    <option value="Tersedia" class="text-green-600 font-bold">Tersedia</option>
                    <option value="Tidak Tersedia" class="text-red-600 font-bold">Tidak Tersedia</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end space-x-6 mt-6">
            <button type="button" 
                class="px-6 py-3 text-lg font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none">
                Batal
            </button>
            <button type="submit" 
                class="px-6 py-3 text-lg font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const input = document.getElementById('gambar');
    const preview = document.getElementById('preview');
    const resetButton = document.getElementById('reset-button');
    const dropText = document.getElementById('drop-text');

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('border-blue-500');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('border-blue-500');
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('border-blue-500');
        const file = e.dataTransfer.files[0];
        handleFile(file);
    });

    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        handleFile(file);
    });

    resetButton.addEventListener('click', () => {
        preview.src = '';
        preview.classList.add('hidden');
        resetButton.classList.add('hidden');
        dropText.classList.remove('hidden');
        input.value = '';
    });

    function handleFile(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                resetButton.classList.remove('hidden');
                dropText.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            alert('File yang diunggah harus berupa gambar.');
        }
    }
</script>

@endsection
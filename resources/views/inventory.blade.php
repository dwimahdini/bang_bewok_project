@extends('layouts.sidebar')

@section('title', 'Inventory')
@section('content')
@vite('resources/css/app.css')

<!-- Filter Pencarian -->
<div class="relative flex mb-4" data-twe-input-wrapper-init data-twe-input-group-ref>
  <input
    type="search"
    class="peer block w-full rounded border border-black bg-white px-3 py-2 leading-6 outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-black placeholder:text-black"
    placeholder="Search"
    aria-label="Search"
    id="search"
    aria-describedby="button-addon1"
    oninput="filterTable()" />
  <button
    class="relative z-10 flex items-center rounded-e bg-black px-5 text-xs font-medium uppercase text-white transition duration-150 ease-in-out hover:bg-gray-800"
    type="button"
    id="button-addon1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
    </svg>
  </button>
</div>

<!-- Data Table -->
<div class="container mx-auto p-4">
  <div class="overflow-x-auto">
    <table id="product-table" class="min-w-full text-sm border-collapse">
      <colgroup>
        <col style="width: 5%;">
        <col style="width: 10%;">
        <col style="width: 20%;">
        <col style="width: 10%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
        <col style="width: 15%;">
        <col style="width: 10%;">
        <col style="width: 15%;">
      </colgroup>
      <thead class="bg-gray-300">
        <tr class="text-left">
          <th class="p-3">Nomor</th>
          <th class="p-3">Gambar</th>
          <th class="p-3">Produk</th>
          <th class="p-3">Jumlah</th>
          <th class="p-3 text-right">Harga</th>
          <th class="p-3">Satuan/berat</th>
          <th class="p-3">Tanggal Kadaluarsa</th>
          <th class="p-3">Status</th>
          <th class="p-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tampil as $item)
        <tr class="border-b product-row">
          <td class="p-3">{{ $loop->iteration }}</td>
          <td>
            <img src="{{ asset('img/' . $item->gambar) }}" alt="Gambar Produk" class="w-20 h-20 object-cover rounded-md">
          </td>
          <td class="p-3">{{ $item->namaProduk }}</td>
          <td class="p-3">{{ $item->jumlah }}</td>
          <td class="p-3 text-right">Rp {{ number_format($item->harga, 2, ',', '.') }}</td>
          <td class="p-3">{{ $item->satuan }}</td>
          <td class="p-3">
            <p>{{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('d M Y') }}</p>
            <p class="text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('l') }}</p>
          </td>
          <td class="p-3">
            <select name="status" class="form-select p-2 rounded dark:bg-gray-50" onchange="updateStatus({{ $item->id }}, this.value)">
              <option value="Tersedia" {{ $item->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
              <option value="Tidak Tersedia" {{ $item->status == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
          </td>
          <td class="p-3">
            <div class="flex gap-2">
              <a href="javascript:void(0);" 
                 class="px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-600 btn-edit"
                 data-id="{{ $item->id }}"
                 data-product='@json($item)'>
                Edit
              </a>
              <form action="/inventory/{{ $item->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600">
                  Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
  <div class="bg-white p-6 rounded-lg w-96">
    <h2 class="text-xl font-bold mb-4">Edit Bahan Baku</h2>
    <form id="editForm" action="" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <!-- Input fields untuk Edit Bahan Baku -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="editNamaProduk" class="block text-lg font-medium text-gray-700">Nama Produk</label>
          <input type="text" id="editNamaProduk" name="namaProduk" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>
        </div>
        <div>
          <label for="editJumlah" class="block text-lg font-medium text-gray-700">Jumlah</label>
          <input type="number" id="editJumlah" name="jumlah" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>
        </div>
        <div>
          <label for="editSatuan" class="block text-lg font-medium text-gray-700">Satuan/Berat</label>
          <input type="text" id="editSatuan" name="satuan" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>
        </div>
        <div>
          <label for="editHarga" class=  "block text-lg font-medium text-gray-700">Harga</label>
          <input type="number" id="editHarga" name="harga" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>
        </div>
        <div>
          <label for="editTanggalKadaluarsa" class="block text-lg font-medium text-gray-700">Tanggal Kadaluarsa</label>
          <input type="date" id="editTanggalKadaluarsa" name="tanggal_kadaluarsa" class="w-full p-3 border border-gray-300 rounded-lg mb-4" required>
        </div>
        <div>
          <label for="editStatus" class="block text-lg font-medium text-gray-700">Status</label>
          <select id="editStatus" name="status" class="w-full p-3 border border-gray-300 rounded-lg mb-4">
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
          </select>
        </div>
      </div>

      <!-- Edit Gambar Produk -->
      <div class="col-span-2">
        <label for="editGambar" class="block text-lg font-medium text-gray-700">Gambar Produk</label>
        <div id="drop-area" 
             class="relative flex flex-col items-center justify-center w-full h-56 p-8 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500">
          <p class="text-gray-500 text-base mb-4" id="drop-text">Seret gambar ke sini atau klik untuk memilih</p>
          <input type="file" id="editGambar" name="gambar" 
                 class="absolute inset-0 opacity-0 cursor-pointer" 
                 accept="image/*">
          <img id="previewEdit" class="hidden w-40 h-40 object-cover rounded-lg mb-4" />
        </div>
      </div>

      <div class="flex justify-between mt-4">
        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
        <button type="button" id="cancelBtn" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
      </div>
    </form>
  </div>
</div>

<script>
document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function() {
        const data = JSON.parse(this.getAttribute('data-product'));
        document.getElementById('editNamaProduk').value = data.namaProduk;
        document.getElementById('editJumlah').value = data.jumlah;
        document.getElementById('editSatuan').value = data.satuan;
        document.getElementById('editHarga').value = data.harga;
        document.getElementById('editTanggalKadaluarsa').value = data.tanggal_kadaluarsa;
        document.getElementById('editStatus').value = data.status;
        
        // Set form action ke rute /inventory/{id}
        document.getElementById('editForm').action = '/inventory/' + data.id;
        
        // Tampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
    });
});

</script>
@endsection

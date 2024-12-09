@extends('layouts.sidebar')
@section('title', 'Pesanan Masuk')
@vite('resources/css/app.css')

@section('content')
<div class="p-1 md:p-1">
    <h1 class="text-2xl font-bold mb-4">Daftar Pesanan Masuk</h1>

    @if(count($pesananMasuk) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg border border-gray-300">
                <thead style="background-color: #C3AB12;">
                    <tr>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">No</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Nama Produk</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Jumlah</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-gray-300">Harga</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-white uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pesananMasuk as $index => $item)
                    <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                        <td class="px-4 py-2 text-center text-xs text-gray-900 border-r border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-center text-xs text-gray-900 border-r border-gray-300">{{ $item->produk->nama_produk }}</td>
                        <td class="px-4 py-2 text-center text-xs text-gray-900 border-r border-gray-300">{{ $item->jumlah }}</td>
                        <td class="px-4 py-2 text-right text-xs text-gray-900 border-r border-gray-300">{{ number_format($item->harga, 2, ',', '.') }}</td>
                        <td class="px-4 py-2 text-right text-xs text-gray-900">{{ number_format($item->total, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol Setujui dan Tidak Setujui -->
        <div class="mt-4 flex justify-end">
            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-300" onclick="openModal('setujui')">Setujui Semua</button>
            <button class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 ml-2" onclick="openModal('tidak_setujui')">Tidak Setujui Semua</button>
        </div>
    @else
        <p class="text-gray-700">Tidak ada pesanan masuk.</p>
    @endif
</div>

<!-- Modal Konfirmasi -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4" id="modalTitle">Konfirmasi</h2>
        <p id="modalMessage">Apakah Anda yakin ingin melanjutkan?</p>
        <div class="mt-4 flex justify-end">
            <button id="confirmButton" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Ya</button>
            <button onclick="closeModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition duration-300 ml-2">Tidak</button>
        </div>
    </div>
</div>

<script>
    let currentAction = '';

    function openModal(action) {
        currentAction = action;
        document.getElementById('modalTitle').innerText = action === 'setujui' ? 'Setujui Semua Pesanan' : 'Tidak Setujui Semua Pesanan';
        document.getElementById('modalMessage').innerText = action === 'setujui' ? 'Apakah Anda yakin ingin menyetujui semua pesanan ini?' : 'Apakah Anda yakin ingin menolak semua pesanan ini?';
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    document.getElementById('confirmButton').addEventListener('click', function() {
        // Lakukan aksi sesuai dengan tombol yang ditekan
        if (currentAction === 'setujui') {
            // Logika untuk menyetujui semua pesanan
            console.log('Semua pesanan disetujui.');
            // Tambahkan logika untuk mengupdate status pesanan di backend
        } else if (currentAction === 'tidak_setujui') {
            // Logika untuk tidak menyetujui semua pesanan
            console.log('Semua pesanan tidak disetujui.');
            // Tambahkan logika untuk mengupdate status pesanan di backend
        }
        closeModal();
    });
</script>
@endsection

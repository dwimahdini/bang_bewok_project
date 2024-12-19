@extends('layouts.sidebar')
@section('title', 'Keranjang Pesanan')
@vite('resources/css/app.css')

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Pesanan Produk Anda</h1>
    <div class="grid grid-cols-1 gap-4">
        @foreach($keranjang as $item)
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <img src="{{ asset('img/' . $item->produk->gambar) }}" alt="Gambar Produk" class="w-16 h-16 object-cover mr-4">
            <div class="flex-1 flex items-center justify-between">
                <p class="text-gray-600 w-1/3 ml-2"><strong>Produk : {{ $item->produk->nama_produk }}</strong></p>
                <p class="text-gray-600 w-1/3 text-center">Jumlah: {{ $item->jumlah }}</p>
                <p class="text-gray-600 w-1/3 text-right mr-4">Total: Rp {{ number_format($item->produk->harga * $item->jumlah, 2, ',', '.') }}</p>
            </div>
            <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="batalPesanan({{ $item->id }})">Batal</button>
        </div>
        @endforeach
    </div>
</div>

<script>
    function batalPesanan(id) {
        fetch(`/keranjang/${id}/batal`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                fetch(`/produk/${id}/update`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: 1
                    })
                })
                .then(updateResponse => {
                    if (updateResponse.ok) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat memperbarui jumlah produk.');
                    }
                });
            } else {
                alert('Terjadi kesalahan saat membatalkan pesanan.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server.');
        });
    }
</script>
@endsection
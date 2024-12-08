@extends('layouts.sidebar')



@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Pengguna Akun</h1>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Posisi</th>
                <th class="py-2 px-4 border-b">Cabang</th>
                <th class="py-2 px-4 border-b">No Tel</th>
                <th class="py-2 px-4 border-b">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penggunaakuns as $index => $penggunaAkun)
            <tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $penggunaAkun->nama }}</td>
                <td class="py-2 px-4 border-b">{{ $penggunaAkun->posisi }}</td>
                <td class="py-2 px-4 border-b">{{ $penggunaAkun->cabang }}</td>
                <td class="py-2 px-4 border-b">{{ $penggunaAkun->notel }}</td>
                <td class="py-2 px-4 border-b">{{ $penggunaAkun->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

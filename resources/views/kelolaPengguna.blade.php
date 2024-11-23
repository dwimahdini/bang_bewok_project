@extends('layouts.sidebar')

@section('title', 'Kelola Pengguna')

@section('content')
@vite('resources/css/app.css')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold leading-tight text-g
                ray-800">
                Kelola Pengguna
            </h2>
            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Pengguna
            </button>
        </div>
        
        <div class="w-full overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nama Staf</th>
                        <th class="py-3 px-6 text-left">Nomor Telepon</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Posisi</th>
                        <th class="py-3 px-6 text-left">Cabang</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-6 text-left whitespace-nowrap">1</td>
                        <td class="py-3 px-6 text-left">Dwi Mahdini</td>
                        <td class="py-3 px-6 text-left">081215660192</td>
                        <td class="py-3 px-6 text-left">dwimahdini12@gmail.com</td>
                        <td class="py-3 px-6 text-left">Admin</td>
                        <td class="py-3 px-6 text-left">1</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                    Edit
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.sidebar')

@section('title', 'Cabang')
@section('content')

@vite('resources/css/app.css')
<div class="space-y-5 p-4 bg-gray-100">
    <!-- Card 1 -->
    <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden">
      <img src="img/bangBewok1.jpg" alt="Foto 1" class="w-40 h-40 object-cover bg-yellow-500">
      <div class="flex-1 p-4">
        <h3 class="text-lg font-bold">Bang Bewok Outlet 1</h3>
        <p class="text-sm text-gray-600 mt-2">
          1A/Krihnarajapuram, 3 rd street sulur<br>
          Pekanbaru - 6313403<br>
          044-653578
        </p>
        <div class="mt-4 flex space-x-3">
          <button class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600">Edit</button>
          <button class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600">Hapus</button>
        </div>
      </div>
    </div>
  
    <!-- Card 2 -->
    <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden">
      <img src="img/bangBewok2.jpg" alt="Foto 2" class="w-40 h-40 object-cover bg-yellow-500">
      <div class="flex-1 p-4">
        <h3 class="text-lg font-bold">Bang Bewok Outlet 2</h3>
        <p class="text-sm text-gray-600 mt-2">
          54 Ramani colony, 3 rd street sulur<br>
          Pekanbaru - 63133452<br>
          044-653763
        </p>
        <div class="mt-4 flex space-x-3">
          <button class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600">Edit</button>
          <button class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600">Hapus</button>
        </div>
      </div>
    </div>
  
    <!-- Card 3 -->
    <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden">
      <img src="img/bangBewokz.jpg" alt="Foto 3" class="w-40 h-40 object-cover bg-yellow-500">
      <div class="flex-1 p-4">
        <h3 class="text-lg font-bold">Bang Bewok Outlet 3</h3>
        <p class="text-sm text-gray-600 mt-2">
          32/ Venkatasamy layout, 3 rd street sulur<br>
          Pekanbaru - 6313403<br>
          044-653578
        </p>
        <div class="mt-4 flex space-x-3">
          <button class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded hover:bg-green-600">Edit</button>
          <button class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600">Hapus</button>
        </div>
      </div>
    </div>
  </div>  
@endsection
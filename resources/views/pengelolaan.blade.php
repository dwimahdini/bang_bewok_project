@extends('layouts.sidebar')

@section('title', 'Pengelolaan')

@vite('resources/css/app.css')

@section('content')
<div class="flex flex-wrap justify-center gap-4 p-4">
    <!-- Card 1 -->
    <div class="w-full sm:w-80 bg-white border border-gray-200 rounded-lg shadow-md transform transition-transform duration-300 hover:scale-105">
      <div class="p-4 flex flex-col items-center">
        <!-- Box icon -->
        <div class="mb-4 p-3 bg-blue-500 text-white rounded-full transition-transform duration-300 transform hover:scale-110">
          <i class="bx bx-cog text-3xl"></i>
        </div>
        <!-- Title -->
        <h2 class="text-2xl font-semibold mb-2">Kelola Akun</h2>
        <!-- Description -->
        <p class="text-gray-600 mb-4 text-center">Memungkinkan admin untuk mengatur data pengguna dengan mudah, termasuk pendaftaran, pengeditan profil, penetapan peran, dan penghapusan akun.</p>
        <!-- Button -->
        <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors duration-300">
          Click Me
        </button>
      </div>
    </div>
  
    <!-- Card 2 -->
    <div class="w-full sm:w-80 bg-white border border-gray-200 rounded-lg shadow-md transform transition-transform duration-300 hover:scale-105">
      <div class="p-4 flex flex-col items-center">
        <!-- Box icon -->
        <div class="mb-4 p-3 bg-green-500 text-white rounded-full transition-transform duration-300 transform hover:scale-110">
          <i class="bx bx-check-circle text-3xl"></i>
        </div>
        <!-- Title -->
        <h2 class="text-2xl font-semibold mb-2">Card Title 2</h2>
        <!-- Description -->
        <p class="text-gray-600 mb-4 text-center">This is another card with its own details. The description explains what this card is about.</p>
        <!-- Button -->
        <button class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition-colors duration-300">
          Click Me
        </button>
      </div>
    </div>
  </div>  
@endsection
 
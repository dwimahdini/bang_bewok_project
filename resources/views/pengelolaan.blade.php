@extends('layouts.sidebar')
@vite('resources/css/app.css')

@section('title', 'Pengelolaan')
@section('content')
<div class="grid grid-cols-2 gap-4">
  <div class="block rounded-lg bg-white shadow-lg dark:bg-surface-dark">
    <div class="relative flex justify-center items-center overflow-hidden bg-cover bg-no-repeat" data-twe-ripple-init data-twe-ripple-color="light">
      <img class="rounded-t-lg" src="{{ asset('img/bangBewok2.jpg') }}" alt="Gambar 1" style="height: 140px; object-fit: cover;" />
      <a href="#!">
        <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
      </a>
    </div>
    <div class="p-5 text-black dark:text-black">
      <h5 class="mb-3 text-lg font-bold leading-tight">Kelola Pengguna</h5>
      <p class="mb-3 text-base font-semibold">
        Tambah, edit, dan hapus akun pengguna.
      </p>
      <a href="/kelolaPengguna" class="inline-block rounded bg-blue-500 px-4 py-2 text-sm font-bold uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700" data-twe-ripple-init data-twe-ripple-color="light">
        disini
      </a>
    </div>
  </div>

  <div class="block rounded-lg bg-white shadow-lg dark:bg-surface-dark">
    <div class="relative flex justify-center items-center overflow-hidden bg-cover bg-no-repeat" data-twe-ripple-init data-twe-ripple-color="light">
      <img class="rounded-t-lg" src="{{ asset('img/bangBewok1.jpg') }}" alt="Gambar 1" style="height: 140px; object-fit: cover;" />
      <a href="#!">
        <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
      </a>
    </div>
    <div class="p-5 text-black dark:text-black">
      <h5 class="mb-3 text-lg font-bold leading-tight">Kelola Cabang</h5>
      <p class="mb-3 text-base font-semibold">
        Tambah, edit, dan hapus cabang.
      </p>
      <a href="/kelola-cabang" class="inline-block rounded bg-blue-500 px-4 py-2 text-sm font-bold uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700" data-twe-ripple-init data-twe-ripple-color="light">
        disini
      </a>
    </div>
  </div>

  <div class="block rounded-lg bg-white shadow-lg dark:bg-surface-dark">
    <div class="relative flex justify-center items-center overflow-hidden bg-cover bg-no-repeat" data-twe-ripple-init data-twe-ripple-color="light">
      <img class="rounded-t-lg" src="{{ asset('img/bangBewok3.jpg') }}" alt="Gambar 1" style="height: 140px; object-fit: cover;" />
      <a href="#!">
        <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
      </a>
    </div>
    <div class="p-5 text-black dark:text-black">
      <h5 class="mb-3 text-lg font-bold leading-tight">Kelola Bahan Baku</h5>
      <p class="mb-3 text-base font-semibold">
        Tambah, edit, dan hapus bahan baku.
      </p>
      <a href="/tambahInventory" class="inline-block rounded bg-blue-500 px-4 py-2 text-sm font-bold uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700" data-twe-ripple-init data-twe-ripple-color="light">
        disini
      </a>
    </div>
  </div>

  <div class="block rounded-lg bg-white shadow-lg dark:bg-surface-dark">
    <div class="relative flex justify-center items-center overflow-hidden bg-cover bg-no-repeat" data-twe-ripple-init data-twe-ripple-color="light">
      <img class="rounded-t-lg" src="{{ asset('img/bangBewok4.jpg') }}" alt="Gambar 1" style="height: 140px; object-fit: cover;" />
      <a href="#!">
        <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
      </a>
    </div>
    <div class="p-5 text-black dark:text-black">
      <h5 class="mb-3 text-lg font-bold leading-tight">Laporan</h5>
      <p class="mb-3 text-base font-semibold">
        Lihat laporan.
      </p>
      <a href="/laporan" class="inline-block rounded bg-blue-500 px-4 py-2 text-sm font-bold uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700" data-twe-ripple-init data-twe-ripple-color="light">
        disini
      </a>
    </div>
  </div>
</div>

<script>
    import {
    Ripple,
    initTWE,
}   from "tw-elements";

    initTWE({ Ripple });
</script>
@endsection
@extends('layouts.sidebar')
@section('title', 'Beranda')
@section('content')
@vite('resources/css/app.css')

<style>
  /* Prevent horizontal scrollbar */
  body {
    overflow-x: hidden;
  }

  /* Ensure elements stay within viewport */
  .no-scroll {
    width: 100%;
    max-width: 100vw;
  }

  .background-section {
    background-size: cover;
    background-position: center;
  }
</style>

<!-- Navbar -->
<!-- Navigation links could be added here -->

<!-- Section 1: Background Image Section -->
<div class="relative h-screen no-scroll background-section" style="background-image: url('{{ asset('img/gambarBangBewok1.jpg') }}');">
  <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-black/60 bg-fixed">
    <div class="flex h-full items-center justify-center">
      <div class="px-6 text-center text-white md:px-12">
        <h1 class="mb-6 text-6xl font-bold">Selamat Datang</h1>
        <h3 class="mb-5 text-2xl font-bold">Sistem Inventory Bahan Baku</h3>
        <button
          type="button"
          class="inline-block rounded border-2 border-neutral-50 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-300 hover:text-neutral-200 focus:border-neutral-300 focus:text-neutral-200 focus:outline-none focus:ring-0 active:border-neutral-300 active:text-neutral-200 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600"
          onclick="document.getElementById('section-2').style.display = 'block'; document.getElementById('section-2').scrollIntoView({ behavior: 'smooth' });">
          Tentang Kami..
        </button>
      </div>
    </div>
  </div>
</div>
<!-- End Section 1 -->

<!-- Section 2: Background Image Section -->
<div id="section-2" class="relative hidden h-screen no-scroll background-section" style="background-image: url('{{ asset('img/gambarBangBewok2.jpg') }}');">
  <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-black/60 bg-fixed">
    <div class="flex h-full items-center justify-center">
      <div class="px-6 text-center text-white md:px-12">
        <h2 class="mb-6 text-4xl font-bold">Tentang Kami</h2>
        <p class="mb-5 text-xl">
          Es Coklat Bang Bewok hadir sebagai salah satu inovasi dalam dunia kuliner, khususnya dalam kategori minuman segar berbasis coklat. Usaha ini didirikan untuk memenuhi kebutuhan pasar akan minuman berkualitas tinggi dengan harga yang terjangkau. Dengan varian menu minuman coklat yang beragam serta camilan pelengkap seperti pentol kuah, roti bakar, dan roti kukus, kami berupaya untuk memberikan pengalaman kuliner yang menyenangkan bagi pelanggan.
        </p>
      </div>
    </div>
  </div>
</div>
<!-- End Section 2 -->

<!-- Initialization Script -->
<script type="module">
  import { Collapse, Ripple, initTWE } from "tw-elements";
  initTWE({ Collapse, Ripple });
</script>

@endsection

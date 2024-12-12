<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="icon" href="img/logo_bang_bewok.png" type="image/png" />
  
  <title>@yield('title', 'Default Title')</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans overflow-hidden">

  <!-- Container utama -->
  <div id="app" class="flex h-screen">
    
    <!-- Sidebar -->
    <aside id="sidebar" class="bg-[#edcf15] shadow-md flex flex-col transition-width w-64 fixed inset-y-0 left-0 z-10">
      <!-- Header Sidebar -->
      <div class="flex items-center gap-4 px-4 py-6 border-b">
        <img src="img/LOGO_BANG_BEWOK.ICO" alt="Logo" class="w-8 h-8 ml-2">
        <span id="sidebar-logo-text" class="text-sm font-semibold text-black-800">Susu Coklat dan Roti Kukus Bang Bewok</span>
      </div>

      <!-- Menu navigasi -->
      <nav id="menu" class="flex-1 px-2 py-6 space-y-4">
        @if(Auth::user()->role === 'admin')
            <a href="/beranda" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
                <i class="bx bx-home-alt text-xl ml-2 text-black"></i>
                <span class="menu-text text-black">Beranda</span>
            </a>
        @endif

        @if(Auth::user()->role != 'admin')
        <a href="/berandaStaf" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-home-alt text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Beranda</span>
        </a>
    @endif
    
    @if(Auth::user()->role != 'staf' )
        <a href="/inventori" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-layer text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Inventori</span>
        </a>
    @endif
    


        @if(Auth::user()->role === 'admin')
        <a href="/penggunaakun" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
          <i class="bx bx-universal-access text-xl ml-2 text-black"></i>
          <span class="menu-text text-black">Kelola Akun</span>
        </a>
        @endif

        @if(Auth::user()->role === 'admin')
        <a href="/pesananMasuk" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-archive-in text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Pesanan Masuk</span>
        </a>
        @endif

        @if(Auth::user()->role === 'staf')
        <a href="/pesan" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-archive-out text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Pesan Bahan Baku</span>
        </a>
        @endif

        @if(Auth::user()->role === 'staf')
        <a href="/keranjangStaf" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-cart-alt text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Keranjang</span>
        </a>
        @endif

        @if(Auth::user()->role === 'admin')
        <a href="/staf" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-group text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Staf</span>
        </a>
        @endif
        
        @if(Auth::user()->role === 'admin')
        <a href="/cabang" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-store-alt text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Cabang</span>
        </a>
        @endif

        <a href="/laporan" class="flex items-center gap-3 text-black hover:bg-blue-100 p-2 rounded">
            <i class="bx bx-clipboard text-xl ml-2 text-black"></i>
            <span class="menu-text text-black">Laporan</span>
        </a>
      </nav>

      <!-- Menu Logout -->
      <a href="/logout" class="flex items-center gap-3 text-red hover:bg-blue-100 p-2 rounded ml-1 mb-1">
          <i class="bx bx-log-out text-xl ml-2 text-red"></i>
          <span class="menu-text text-black">Log Out</span>
      </a>
    </aside>

    <!-- Main content -->
    <div id="main-content" class="flex-1 flex flex-col ml-64 transition-all duration-300">
      <!-- Header bar -->
      <header class="flex items-center justify-between bg-white shadow p-6">
        <button id="toggle-sidebar" class="text-gray-700">
          <i class="bx bx-menu text-2xl"></i>
        </button>
        <div class="flex items-center gap-4 mr-4">
        <!-- Tombol notifikasi -->
        <button class="relative" id="notification-button">
        <i class="bx bx-bell text-2xl text-gray-700"></i>
        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
        </button>
      
          <!-- Profil pengguna -->
          <div class="flex items-center gap-2">
            <span class="text-gray-700 font-bold">{{ Auth::user()->name }}</span>
          </div>          
        </div>
      </header>

      @if(isset($produkMenipisKadaluarsa) && $produkMenipisKadaluarsa->count() > 0)
      <div id="notification-content" class="absolute top-14 right-28 w-96 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 shadow-xl rounded-lg hidden">
        <strong>Perhatian!</strong> Terdapat {{ $produkMenipisKadaluarsa->count() }} produk yang mendekati kadaluarsa dalam 30 hari.
        <button id="close-notification" class="text-sm text-gray-500 ml-2">Tutup</button>
    </div>
    
    @endif
    

      

      <!-- Content area -->
      <main class="flex-1 p-6 overflow-y-auto">
        @yield('content') <!-- Konten spesifik dari halaman -->
      </main>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    // Variabel untuk elemen sidebar dan tombol toggle
    const sidebar = document.getElementById('sidebar');
    const toggleSidebarButton = document.getElementById('toggle-sidebar');
    const mainContent = document.getElementById('main-content');
    const menuTexts = document.querySelectorAll('.menu-text');
    const logoText = document.getElementById('sidebar-logo-text');

    // Event listener untuk toggle sidebar
    toggleSidebarButton.addEventListener('click', () => {
      if (sidebar.classList.contains('w-64')) {
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-20');
        logoText.classList.add('hidden'); // Sembunyikan teks logo
        menuTexts.forEach(text => text.classList.add('hidden')); // Sembunyikan teks menu
        mainContent.classList.remove('ml-64');
        mainContent.classList.add('ml-20'); // Sesuaikan margin untuk konten utama
      } else {
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64');
        logoText.classList.remove('hidden'); // Tampilkan teks logo
        menuTexts.forEach(text => text.classList.remove('hidden')); // Tampilkan teks menu
        mainContent.classList.remove('ml-20');
        mainContent.classList.add('ml-64'); // Sesuaikan margin untuk konten utama
      }
    });

    document.addEventListener('DOMContentLoaded', function () {
    // Mendapatkan elemen notifikasi dan tombol notifikasi
    const notification = document.getElementById('notification-content');
    const notificationButton = document.getElementById('notification-button');
    const closeButton = document.getElementById('close-notification');
    
    // Memastikan notifikasi muncul otomatis setelah halaman dimuat jika ada produk mendekati kadaluarsa
    if (notification) {
        notification.classList.remove('hidden'); // Menampilkan notifikasi
        // Menutup notifikasi setelah 5 detik
        setTimeout(function() {
            notification.classList.add('hidden'); // Menyembunyikan notifikasi setelah 5 detik
        }, 2000);
    }

    // Fungsi untuk menampilkan atau menyembunyikan notifikasi saat tombol bel diklik
    notificationButton.addEventListener('click', function() {
        notification.classList.toggle('hidden'); // Menyembunyikan atau menampilkan notifikasi saat tombol bel diklik
    });

    // Menutup notifikasi jika tombol "Tutup" diklik
    closeButton.addEventListener('click', function() {
        notification.classList.add('hidden'); // Menyembunyikan notifikasi jika tombol "Tutup" diklik
    });
});




  </script>
</body>
</html>
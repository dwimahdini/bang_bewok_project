<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <link rel="icon" href="img/logo_bang_bewok.png" type="image/png" />
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" />
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
  </head>
  
  <body>
    <nav class="sidebar">
      <div class="logo">
        <div class="logo-icon">
          <img src="img/logo_bang_bewok.png" alt="Logo" style="width: 60px; height: 60px;">
        </div>
        <span class="logo_name" style="font-size: 14px;">Es Coklat dan Roti Susu Bang Bewok</span>
      </div>
      <div class="menu-items">
        <ul class="nav-links">
          <li>
            <a href="/beranda">
                <i class='bx bx-home-alt'></i>
              <span class="link-name">Beranda</span>
            </a>
          </li>
          <li>
            <a href="/inventori">
                <i class='bx bx-layer'></i>
              <span class="link-name">Inventori</span>
            </a>
          </li>
          <li>
            <a href="/pengelolaan">
                <i class='bx bx-cog'></i>
              <span class="link-name">Pengelolaan</span>
            </a>
          </li>
          <li>
            <a href="/pesananMasuk">
                <i class='bx bx-archive-in'></i>
              <span class="link-name">Pesanan Masuk</span>
            </a>
          </li>
          <li>
            <a href="/pesan">
                <i class='bx bx-archive-out' ></i>
              <span class="link-name">Pesan Bahan Baku</span>
            </a>
          </li>
          <li>
            <a href="/staf">
                <i class='bx bx-group'></i>
              <span class="link-name">Staf</span>
            </a>
          </li>
          <li>
            <a href="/cabang">
              <i class='bx bx-store-alt' ></i>
              <span class="link-name">Cabang</span>
            </a>
          </li>
          <li>
            <a href="/laporan">
                <i class='bx bx-clipboard'></i>
              <span class="link-name">Laporan</span>
            </a>
          </li>
        </ul>

        <ul class="logout-mode">
          <li>
            <a href="/logout">
                <i class='bx bx-log-out'></i>
              <span class="link-name">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <section class="dashboard">
      <div class="top" style="border-bottom: 2px solid #F6EBA6;">
        <i class="fas fa-bars sidebar-toggle"></i>
        <div class="logo-container" style="display: flex; align-items: center;">
          <i class="bx bx-bell" style="font-size: 20px; margin-right: 15px;"></i>
          <span style="font-size: 15px; margin-right: 10px;">Admin</span>
          <img src="img/logo.png" alt="" style="border: 1px solid #000;"/>
        </div>
      </div>

      <div class="content">
        @yield('content')
      </div>
    </section>
    
    <script src="js/script.js"></script>
    <script>
      const sidebarToggle = document.querySelector('.sidebar-toggle');
      const sidebar = document.querySelector('.sidebar');

      sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('close');
      });
    </script>
  </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="icon" href="{{ asset('img/logo_bang_bewok.png') }}" type="image/x-icon">
	<title>@yield('title')</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="{{ asset('img/logo_bang_bewok.png') }}" alt="Logo" class="brand-logo">
			<span class="text">Es Coklat dan Roti Kukus Bang Bewok</span>
		</a>		
		<ul class="side-menu top">
			<li class="active">
				<a href="/beranda">
					<i class='bx bx-home-alt'></i>
					<span class="text">Beranda</span>
				</a>
			</li>
			<li>
				<a href="/inventory">
					<i class='bx bx-layer'></i>
					<span class="text">Inventory</span>
				</a>
			</li>
			<li>
				<a href="/pengelolaan">
					<i class='bx bx-cog'></i>
					<span class="text">Pengelolaan</span>
				</a>
			</li>
			<li>
				<a href="/pesananMasuk">
					<i class='bx bx-archive-in'></i>
					<span class="text">Pesanan Masuk</span>
				</a>
			</li>
			<li>
				<a href="/pesan">
					<i class='bx bx-archive-out' ></i>
					<span class="text">Pesan Bahan Baku</span>
				</a>
			</li>
			<li>
				<a href="/laporan">
					<i class='bx bx-clipboard'></i>
					<span class="text">Laporan</span>
				</a>
			</li>
			<li>
				<a href="/cabang">
					<i class='bx bx-group'></i>
					<span class="text">Cabang</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/logout" class="logout">
					<i class='bx bx-log-out'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">

	<!-- NAVBAR -->
	<nav>
    	<div class="nav-left">
        	<i class='bx bx-menu'></i>
    	</div>
    	<div class="nav-right">
        	<a href="#" class="notification">
            	<i class='bx bxs-bell'></i>
            	<span class="num">8</span>
        	</a>
        	<a href="#" class="profile">
            	<img src="{{ asset('img/logo.png') }}">
        	</a>
    	</div>
	</nav>
	<!-- NAVBAR -->


		<!-- MAIN CONTENT -->
		<main>
			@yield('content')
		</main>
		<!-- MAIN CONTENT -->
	</section>
	<!-- CONTENT -->
	
	<script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
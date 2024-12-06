<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bang Bewok Es Coklat</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-yellow {
            background-color: #edcf15;
        }
        .custom-brown {
            color: #653504;
        }
        .bg-brown {
            background-color: #653504;
        }
        
    </style>
</head>
<body class="bg-white text-gray-800 scroll-smooth">

    <!-- Header -->
    <header class="custom-yellow text-white shadow-lg fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/logo_bang_bewok.png') }}" alt="Bang Bewok Logo" class="w-12 h-12 rounded-full mr-3">
                <h1 class="text-2xl font-bold custom-brown">Bang Bewok</h1>
            </div>
            <!-- Navigation -->
            <nav>
                <ul class="flex space-x-6 text-lg custom-brown">
                    <li><a href="#home" class="hover:text-white">Home</a></li>
                    <li><a href="#products" class="hover:text-white">Products</a></li>
                    <li><a href="#about" class="hover:text-white">About</a></li>
                    <li><a href="#contact" class="hover:text-white">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="h-screen flex items-center justify-center text-center relative custom-yellow">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl md:text-6xl font-bold custom-brown">Rasakan Kesegaran Es Coklat</h1>
            <p class="mt-4 text-lg text-gray-700">Segelas kenikmatan coklat untuk setiap momen berharga.</p>
            <a href="#products" class="mt-6 inline-block bg-brown text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold hover:bg-yellow-600 transition duration-300">
                Lihat Produk
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold custom-brown">Tentang Kami</h2>
            <p class="mt-4 text-gray-600">Kami menghadirkan es coklat terbaik dari bahan-bahan pilihan.</p>
            <div class="mt-10 flex justify-center">
                <img src="https://via.placeholder.com/300x300" alt="About Us" class="rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Our Products Section -->
    <section id="products" class="py-20 bg-yellow-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold custom-brown">Produk Kami</h2>
            <p class="mt-4 text-gray-600">Pilih dari berbagai varian es coklat spesial.</p>
            <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Product 1 -->
                <div class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transform transition duration-500 hover:scale-105">
                    <img src="https://via.placeholder.com/150" alt="Es Coklat Original" class="w-full h-40 object-cover rounded-md">
                    <h3 class="mt-4 text-xl font-bold custom-brown">Es Coklat Original</h3>
                    <p class="mt-2 text-gray-600">Rasa klasik coklat yang tidak tergantikan.</p>
                    <button class="mt-4 bg-brown text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Pesan Sekarang</button>
                </div>
                <!-- Product 2 -->
                <div class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transform transition duration-500 hover:scale-105">
                    <img src="https://via.placeholder.com/150" alt="Es Coklat Alpukat" class="w-full h-40 object-cover rounded-md">
                    <h3 class="mt-4 text-xl font-bold custom-brown">Es Coklat Alpukat</h3>
                    <p class="mt-2 text-gray-600">Campuran coklat dan alpukat yang creamy.</p>
                    <button class="mt-4 bg-brown text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Pesan Sekarang</button>
                </div>
                <!-- Product 3 -->
                <div class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transform transition duration-500 hover:scale-105">
                    <img src="https://via.placeholder.com/150" alt="Es Coklat Keju" class="w-full h-40 object-cover rounded-md">
                    <h3 class="mt-4 text-xl font-bold custom-brown">Es Coklat Keju</h3>
                    <p class="mt-2 text-gray-600">Lelehan keju yang nikmat berpadu dengan coklat.</p>
                    <button class="mt-4 bg-brown text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Pesan Sekarang</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brown text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2024 Bang Bewok Es Coklat. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
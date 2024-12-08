<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="absolute top-0 left-0 w-1/2 h-full bg-white"></div>
    <div class="absolute top-0 right-0 w-1/2 h-full bg-yellow-400"></div>

    <div class="relative flex w-4/5 max-w-4xl shadow-xl bg-white rounded-lg overflow-hidden">
        <!-- Left Section -->
        <div class="flex flex-col items-center justify-center w-1/2 bg-yellow-400 p-10 text-center">
            <img src="img/logo_bang_bewok.png" alt="Logo Bang Bewok" class="w-40 mb-5">
            <h1 class="text-2xl font-bold text-black">SISTEM INVENTORY BAHAN BAKU</h1>
        </div>

        <!-- Right Section -->
        <div class="flex flex-col justify-center w-1/2 bg-white p-10">
            <img src="img/logo_bang_bewok.png" alt="Logo" class="w-12 mx-auto mb-5 rounded-full">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">LOGIN</h2>
            <p class="text-center text-gray-500 mb-6">Silahkan Login</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan Email Anda" 
                        class="w-3/4 mx-auto block px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password Anda" 
                        class="w-3/4 mx-auto block px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>
                <div class="flex justify-between items-center w-3/4 mx-auto mb-6 text-sm text-gray-600">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Ingatkan Saya
                    </label>
                    <a href="#" class="text-blue-500 hover:underline">Lupa Password</a>
                </div>
                <button type="submit" 
                    class="w-3/4 mx-auto block px-4 py-2 bg-black text-white rounded-md text-center hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    Login
                </button>
            </form>
            
            <div class="text-center mt-4 text-sm">
                Belum Memiliki Akun? <a href="#" class="text-blue-500 hover:underline">Buat Akun</a>
            </div>
        </div>
    </div>
</body>
</html>
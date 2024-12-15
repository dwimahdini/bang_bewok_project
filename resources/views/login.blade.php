<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'inter', sans-serif;
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
            <h1 class="text-2xl font-bold text-black">SISTEM MANAJEMEN INVENTORI BAHAN BAKU</h1>
        </div>

        <!-- Right Section -->
        <div class="flex flex-col justify-center w-1/2 bg-white p-10">
            <img src="img/logo_bang_bewok.png" alt="Logo" class="w-12 mx-auto mb-5 rounded-full">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">LOGIN</h2>
            <p class="text-center text-gray-500 mb-6">Silahkan Login</p>
            <form method="POST" action="{{ url('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan Email Anda" autocomplete="on"
                        class="w-full mx-auto block px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-700 text-sm mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password Anda" autocomplete="on"
                        class="w-full mx-auto block px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password absolute right-3 top-10 cursor-pointer"></span>
                </div>
                <button type="submit" 
                    class="w-3/4 mx-auto block px-4 py-2 bg-black text-white rounded-md text-center hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    Login
                </button>
            </form>
            
            
            <div class="text-center mt-4 text-sm">
                Belum Memiliki Akun? <a href="#" class="text-blue-500 hover:underline">Hubungi Admin</a>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.toggle-password').addEventListener('click', function () {
            const passwordField = document.querySelector('#password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
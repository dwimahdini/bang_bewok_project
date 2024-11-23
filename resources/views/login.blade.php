<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Inventory</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo_bang_bewok.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
    <body>
        <div class="background">
            <div class="left"></div>
            <div class="right"></div>
        </div>
    
        <div class="container">
            <div class="left-section">
                <img src="img/logo_bang_bewok.png" alt="Logo Bang Bewok">
                <h1>SISTEM INVENTORY BAHAN BAKU</h1>
            </div>
    
            <div class="right-section">
                <img src="img/logo_bang_bewok.png" alt="Logo" style="width: 50px; margin: 0 auto 20px; display: block; border-radius: 30px;">
                <h2>LOGIN</h2>
                <p>Silahkan Login</p>
                <form>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Masukkan Email Anda">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Masukkan Password Anda">
                    </div>
                    <div class="form-options">
                        <label>
                            <input type="checkbox" name="remember"> Ingatkan Saya
                        </label>
                        <a href="#">Lupa Password</a>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </form>
                <div class="register-link">
                    Belum Memiliki Akun? <a href="#">Buat Akun</a>
                </div>
            </div>
        </div>
    </body>
</head>
</html>
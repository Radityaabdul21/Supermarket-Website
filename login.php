<?php
// =======================
// PROSES LOGIN DI SINI
// =======================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Contoh pengecekan (bisa diganti dengan database)
    if ($nama == "admin" && $password == "123") {
        header("Location: Beranda.php");
        exit;
    } else {
        $error = "Nama atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Snap Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { height: 100vh; overflow: hidden; display: flex; background-image: url("image supermarket/background login dan regis.png"); background-size: cover; }

        .form-side {
            width: 45%;
            background-color: #3A7D25; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            border-top-right-radius: 100% 50%; 
            border-bottom-right-radius: 100% 50%;
            z-index: 2;
            box-shadow: 5px 0 15px rgba(0,0,0,0.2);
            transform: translateX(-100%);
            animation: slideInLeft 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
        }

        .slide-out-left { animation: slideOutLeft 0.6s ease-in forwards; }

        .image-side {
            width: 55%;
            margin-left: -50px;
            background: url('login.jpg') no-repeat center right/cover;
            position: relative;
            z-index: 1;
            animation: fadeIn 1.2s ease-out;
        }

        .container { width: 80%; max-width: 350px; text-align: center; color: white; }

        @keyframes slideInLeft { from { transform: translateX(-100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes slideOutLeft { from { transform: translateX(0); opacity: 1; } to { transform: translateX(-100%); opacity: 0; } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .logo i { font-size: 40px; transform: rotate(-10deg); margin-bottom: 10px; color: #e8f0ca; }
        .logo h2 { font-size: 24px; font-weight: bold; }
        .welcome-text { font-size: 36px; font-weight: bold; margin-bottom: 30px; }
        .input-group { position: relative; margin-bottom: 20px; }
        .input-group input { width: 100%; padding: 15px; border-radius: 8px; border: none; outline: none; font-size: 16px; }
        .toggle-pw { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #333; cursor: pointer; }
        .btn-login { width: 100%; padding: 15px; border-radius: 8px; border: none; background-color: #7D9BB9; color: black; font-weight: bold; font-size: 18px; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: 0.3s; }
        .btn-login:hover { background-color: #6c8ba8; }
        .footer-text { margin-top: 20px; font-size: 14px; }
        .btn-daftar { background: rgba(255,255,255,0.3); color: white; padding: 8px 20px; border-radius: 20px; margin-top: 10px; display: inline-block; text-decoration: none; cursor: pointer; transition: 0.3s; }
        .btn-daftar:hover { background: rgba(255,255,255,0.5); transform: scale(1.05); }

        @media (max-width: 768px) {
            body { flex-direction: column; overflow: auto; }
            .image-side { display: none; }
            .form-side { width: 100%; height: 100vh; border-radius: 0; animation: fadeIn 1s; }
        }
    </style>
</head>
<body>

    <div class="form-side" id="formContainer">
        <div class="container">
            <div class="logo">
                <i class="fas fa-shopping-bag"></i>
                <h2>Snap Shop</h2>
            </div>

            <h1 class="welcome-text">Welcome Back</h1>

            <?php if (!empty($error)) : ?>
                <p style="color: yellow; margin-bottom: 10px;"><?= $error ?></p>
            <?php endif; ?>

            <form id="loginForm" method="POST" action="login.php">
                
                <div class="input-group">
                    <input type="text" name="nama" placeholder="Nama Anda" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password Anda" required>
                    <i class="fa-solid fa-eye-slash toggle-pw"></i>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <div class="footer-text">
                <p>Belum punya akun?</p>
                <a href="register.php" class="btn-daftar">Daftar Disini</a>
            </div>
        </div>
    </div>

    <div class="image-side"></div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Snap Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { height: 100vh; overflow: hidden; display: flex; background-image: url("image supermarket/background\ login\ dan\ regis.png"); background-size: cover; }

        /* --- BAGIAN KIRI: GAMBAR --- */
        .image-side {
            width: 55%;
            background: url('Register.jpg') no-repeat center left/cover; 
            position: relative;
            z-index: 1;
            /* Animasi Gambar: Fade In pelan */
            animation: fadeIn 1.2s ease-out;
        }

        /* --- BAGIAN KANAN: FORM HIJAU --- */
        .form-side {
            width: 45%;
            background-color: #3A7D25; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            border-top-left-radius: 100% 50%; 
            border-bottom-left-radius: 100% 50%;
            margin-left: -50px;
            box-shadow: -5px 0 15px rgba(0,0,0,0.2);
            z-index: 2;
            
            /* INITIAL STATE: Biar animasi jalan saat pertama buka */
            transform: translateX(100%); 
            animation: slideInRight 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
        }

        /* Kelas untuk animasi KELUAR (Saat mau pindah ke Login) */
        .slide-out-right {
            animation: slideOutRight 0.6s ease-in forwards;
        }

        .container { width: 80%; max-width: 350px; text-align: center; color: white; }

        /* --- KEYFRAMES ANIMASI --- */
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* ... (Style Form Sama Seperti Sebelumnya) ... */
        .header h1 { font-size: 32px; margin-bottom: 5px; }
        .logo { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 30px; }
        .logo i { font-size: 24px; transform: rotate(-10deg); border: 2px solid white; padding: 5px; border-radius: 5px; }
        .logo span { font-size: 20px; font-weight: bold; }
        .input-group { position: relative; margin-bottom: 15px; }
        .input-group input { width: 100%; padding: 12px 15px; border-radius: 8px; border: none; outline: none; font-size: 14px; }
        .toggle-pw { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #333; cursor: pointer; }
        .btn-register { width: 100%; padding: 12px; border-radius: 8px; border: none; background-color: #7D9BB9; color: black; font-weight: bold; font-size: 16px; cursor: pointer; margin-top: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: 0.3s; }
        .btn-register:hover { background-color: #6c8ba8; }
        .social-login { margin-top: 20px; display: flex; justify-content: center; gap: 15px; }
        .social-btn { width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; cursor: pointer; transition: transform 0.2s; background: white; }
        .social-btn:hover { transform: scale(1.1); }
        .google { color: #DB4437; }
        .facebook { background-color: #1877F2; color: white; }

        /* Popup Styles */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: none; justify-content: center; align-items: center; z-index: 1000; opacity: 0; transition: opacity 0.3s; }
        .modal-overlay.show { opacity: 1; }
        .modal-box { background: white; padding: 30px; border-radius: 15px; text-align: center; width: 300px; box-shadow: 0 5px 20px rgba(0,0,0,0.3); transform: scale(0.8); transition: transform 0.3s; }
        .modal-overlay.show .modal-box { transform: scale(1); }
        .modal-box i { font-size: 50px; color: #3A7D25; margin-bottom: 15px; }
        .btn-modal { background: #3A7D25; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; width: 100%; font-weight: bold; }

        @media (max-width: 768px) { body { flex-direction: column; overflow: auto; } .image-side { display: none; } .form-side { width: 100%; height: 100vh; border-radius: 0; margin: 0; transform: none; animation: fadeIn 1s; } }
    </style>
</head>
<body>

    <div class="image-side"></div>

    <div class="form-side" id="formContainer">
        <div class="container">
            <div class="header"><h1>Welcome To</h1></div>
            <div class="logo"><i class="fas fa-shopping-bag"></i><span>Snap Shop</span></div>

            <form id="registerForm">
                <div class="input-group"><input type="email" placeholder="Email" required></div>
                <div class="input-group"><input type="password" placeholder="Password Anda" required><i class="fa-solid fa-eye-slash toggle-pw"></i></div>
                <div class="input-group"><input type="password" placeholder="Confirm Password" required><i class="fa-solid fa-eye-slash toggle-pw"></i></div>
                <button type="submit" class="btn-register">Register</button>
            </form>

            <div class="social-login">
                <div class="social-btn google" onclick="loginSosmed('Google')"><i class="fab fa-google"></i></div>
                <div class="social-btn facebook" onclick="loginSosmed('Facebook')"><i class="fab fa-facebook-f"></i></div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="successModal">
        <div class="modal-box">
            <i class="fas fa-check-circle"></i>
            <h3>Berhasil!</h3>
            <p>Akun berhasil dibuat.</p>
            <button class="btn-modal" onclick="goToLogin()">Lanjut ke Login</button>
        </div>
    </div>

    <script>
        const modal = document.getElementById('successModal');
        const formContainer = document.getElementById('formContainer');

        function showPopup() {
            modal.style.display = 'flex';
            setTimeout(() => { modal.classList.add('show'); }, 10);
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) { e.preventDefault(); showPopup(); });
        
        function loginSosmed(platform) {
            alert("Menghubungkan ke " + platform + "...");
            setTimeout(() => { showPopup(); }, 500);
        }

        // --- ANIMASI TRANSISI KE LOGIN ---
        function goToLogin() {
            // 1. Tambahkan kelas animasi keluar
            formContainer.classList.remove('slideInRight'); // hapus animasi masuk
            formContainer.classList.add('slide-out-right'); // tambah animasi keluar

            // 2. Tunggu animasi selesai (600ms) baru pindah halaman
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 600);
        }
    </script>
</body>
</html>




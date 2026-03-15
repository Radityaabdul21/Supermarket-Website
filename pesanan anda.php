<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan - Snap Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <style>
        :root {
            --primary-green: #558B2F; 
            --light-green: #8BC34A;
            --gradient-bg: linear-gradient(135deg, #f1f8e9 0%, #dcedc8 100%);
            --card-bg: #ffffff;
            --text-dark: #333;
            --shadow-color: rgba(85, 139, 47, 0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', 'Segoe UI', sans-serif; }
        
        /* Background Keren dengan Gradasi */
        body { 
            background: var(--gradient-bg); 
            padding-bottom: 80px; 
            min-height: 100vh;
        }

        /* --- HEADER & SIDEBAR --- */
        .navbar {
            background: linear-gradient(to right, #558B2F, #7CB342); /* Header Gradient */
            padding: 15px 20px;
            display: flex; align-items: center; position: sticky; top: 0; z-index: 1000;
            color: white; box-shadow: 0 4px 15px rgba(85, 139, 47, 0.3);
        }
        .nav-left { display: flex; align-items: center; font-size: 22px; cursor: pointer; margin-right: 15px; }
        .page-title { font-size: 18px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); }

        /* Sidebar Style */
        .sidebar { position: fixed; left: -280px; top: 0; height: 100%; width: 250px; background: white; z-index: 2000; transition: 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55); box-shadow: 5px 0 20px rgba(0,0,0,0.1); padding-top: 60px; }
        .sidebar.active { left: 0; }
        .sidebar-close { position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; color: var(--primary-green); }
        .sidebar a { padding: 15px 20px; text-decoration: none; font-size: 16px; color: #333; display: flex; align-items: center; gap: 15px; border-bottom: 1px solid #f0f0f0; transition: 0.3s; }
        .sidebar a:hover { background-color: #f1f8e9; color: var(--primary-green); padding-left: 25px; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1500; display: none; backdrop-filter: blur(3px); }
        .overlay.active { display: block; }

        /* --- CONTENT FORM --- */
        .container { max-width: 600px; margin: 30px auto; padding: 0 20px; }

        
        /* Style Keren Input Box (Card Style) */
        .form-group {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex; flex-direction: column; justify-content: center;
            /* Efek Bayangan & Border Halus */
            box-shadow: 0 10px 20px var(--shadow-color);
            border-left: 5px solid var(--primary-green); /* Aksen Hijau di Kiri */
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative; overflow: hidden;
        }
        
        .order-card {
            background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 15px;
            transition: transform 0.2s; border: 1px solid #eee;
        }
        .order-card:hover { transform: translateY(-3px); }

        .order-img { width: 70px; height: 70px; object-fit: contain; border: 1px solid #eee; border-radius: 8px; padding: 5px; }
        
        .order-info { flex-grow: 1; }
        .order-status { font-size: 14px; font-weight: bold; color: #333; margin-bottom: 5px; }
        .order-est { font-size: 13px; color: #666; display: flex; align-items: center; gap: 5px; }
        .truck-icon { color: var(--primary-green); font-size: 16px; }

        .btn-detail {
            background: white; border: 1px solid #ccc; padding: 8px 15px; border-radius: 20px;
            font-size: 13px; font-weight: bold; color: #555; cursor: pointer; text-decoration: none;
            transition: 0.2s; white-space: nowrap;
        }
        .btn-detail:hover { background: var(--primary-green); color: white; border-color: var(--primary-green); }

    </style>
</head>
<body>

    <div class="overlay" id="overlay"></div>
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-close" id="closeSidebar">&times;</div>
        <div style="text-align: center; margin-bottom: 20px;">
            <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i>
            <p style="margin-top: 10px; font-weight: bold;">Nama Akun</p>
        </div>
        <a href="home.html"><i class="fas fa-home"></i> Beranda</a>
        <a href="category.html"><i class="fas fa-list"></i> Kategori</a>
        <a href="keranjang.html"><i class="fas fa-shopping-cart"></i> Keranjang</a>
        <a href="pesanan-saya.html" style="background:#f0f0f0;"><i class="fas fa-truck"></i> Pesanan Saya</a>
        <a href="riwayat.html"><i class="fas fa-history"></i> Riwayat</a>
        <a href="contact.html"><i class="fas fa-headset"></i> Contact Us</a>
        <a href="ubah-profil.html"><i class="fas fa-user-edit"></i> Ubah Profil</a>
        <a href="index.html" style="color: red;"><i class="fas fa-sign-out-alt"></i> Keluar</a>
    </nav>

    <header class="navbar">
        <div class="nav-left" id="openSidebar"><i class="fas fa-bars"></i></div>
        <div class="page-title">Pembayaran Berhasil</div>
    </header>

    <div class="container">
        
        <div class="order-card">
            <img src="https://via.placeholder.com/150x150/fdfbe0/333?text=Sarden" class="order-img">
            <div class="order-info">
                <div class="order-status">Pesanan sedang dikemas oleh Penjual</div>
                <div class="order-est">Estimasi 1 Hari <i class="fas fa-truck truck-icon"></i></div>
            </div>
            <a href="#" class="btn-detail">Detail Pesanan</a>
        </div>

        <div class="order-card">
            <img src="https://via.placeholder.com/150x150/fdfbe0/333?text=Dancow" class="order-img">
            <div class="order-info">
                <div class="order-status">Pesanan sedang dalam perjalanan</div>
                <div class="order-est">Estimasi 1 Hari <i class="fas fa-truck truck-icon"></i></div>
            </div>
            <a href="#" class="btn-detail">Detail Pesanan</a>
        </div>

        <div class="order-card">
            <img src="https://via.placeholder.com/150x150/fdfbe0/333?text=PediaSure" class="order-img">
            <div class="order-info">
                <div class="order-status">Pesanan telah sampai di Hub Bekasi</div>
                <div class="order-est">Estimasi 1 Hari <i class="fas fa-truck truck-icon"></i></div>
            </div>
            <a href="#" class="btn-detail">Detail Pesanan</a>
        </div>

    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openSidebar');
        const closeSideBtn = document.getElementById('closeSidebar');

        function toggleSidebar() { sidebar.classList.toggle('active'); overlay.classList.toggle('active'); }
        openBtn.addEventListener('click', toggleSidebar);
        closeSideBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>
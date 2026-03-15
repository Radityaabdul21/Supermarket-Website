<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Snap Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-green: #558B2F; --bg-color: #f4f4f4; --white: #ffffff; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); padding-bottom: 80px; }

        /* HEADER & SIDEBAR */
        .navbar { background-color: #9CCC65; padding: 15px 20px; display: flex; align-items: center; position: sticky; top: 0; z-index: 1000; color: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .nav-left { font-size: 20px; cursor: pointer; margin-right: 15px; }
        .page-title { font-size: 18px; font-weight: bold; }
        .sidebar { position: fixed; left: -280px; top: 0; height: 100%; width: 250px; background: white; z-index: 2000; transition: 0.3s; box-shadow: 2px 0 10px rgba(0,0,0,0.1); padding-top: 60px; }
        .sidebar.active { left: 0; }
        .sidebar-close { position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; color: var(--primary-green); }
        .sidebar a { padding: 15px 20px; text-decoration: none; font-size: 16px; color: #333; display: flex; align-items: center; gap: 15px; border-bottom: 1px solid #eee; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1500; display: none; }
        .overlay.active { display: block; }

        /* CONTENT */
        .container { max-width: 800px; margin: 20px auto; padding: 0 15px; }

        .history-card {
            background: white; border-radius: 10px; margin-bottom: 20px; overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #eee;
        }

        .card-header {
            padding: 10px 15px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between;
            font-size: 12px; color: #666; background: #fafafa;
        }
        .status-done { color: var(--primary-green); font-weight: bold; display: flex; align-items: center; gap: 5px; }

        .card-body { padding: 15px; display: flex; gap: 15px; }
        .product-img { width: 80px; height: 80px; object-fit: contain; border: 1px solid #eee; border-radius: 8px; }
        .product-info { flex-grow: 1; }
        .p-name { font-weight: bold; font-size: 15px; color: #333; margin-bottom: 5px; }
        .p-meta { font-size: 12px; color: #777; margin-bottom: 5px; }
        .p-qty { font-size: 13px; font-weight: bold; color: #333; }
        .p-total-price { text-align: right; font-weight: bold; font-size: 14px; color: var(--primary-green); }

        .card-footer {
            padding: 10px 15px; border-top: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center;
        }
        .total-label { font-size: 13px; font-weight: bold; }
        .total-value { font-size: 16px; font-weight: bold; color: var(--primary-green); }

        .btn-group { display: flex; gap: 10px; margin-top: 10px; justify-content: flex-end; padding: 0 15px 15px; }
        .btn {
            padding: 8px 15px; border-radius: 5px; font-size: 13px; font-weight: bold; cursor: pointer; border: none; text-decoration: none; display: inline-block;
        }
        .btn-rate { background: #558B2F; color: white; }
        .btn-buy-again { background: white; border: 1px solid #558B2F; color: #558B2F; }
        .btn-buy-again:hover { background: #f0f8ef; }

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
        <a href="beranda.html"><i class="fas fa-home"></i> Beranda</a>
        <a href="Kategori.html"><i class="fas fa-list"></i> Kategori</a>
        <a href="keranjang.html"><i class="fas fa-shopping-cart"></i> Keranjang</a>
        <a href="pesanan anda.html"><i class="fas fa-truck"></i> Pesanan Saya</a>
        <a href="Riwayat.html" style="background:#f0f0f0;"><i class="fas fa-history"></i> Riwayat</a>
        <a href="contact.html"><i class="fas fa-headset"></i> Contact Us</a>
        <a href="ubahprofile.html"><i class="fas fa-user-edit"></i> Ubah Profil</a>
        <a href="login.html" style="color: red;"><i class="fas fa-sign-out-alt"></i> Keluar</a>
    </nav>

    <header class="navbar">
        <div class="nav-left" id="openSidebar"><i class="fas fa-bars"></i></div>
        <div class="page-title">Riwayat Pesanan</div>
    </header>

    <div class="container">

        <div class="history-card">
            <div class="card-header">
                <span><i class="fas fa-store"></i> Snap Shop Official</span>
                <span class="status-done"><i class="fas fa-check-circle"></i> Selesai</span>
            </div>
            <div class="card-body">
                <img src="https://via.placeholder.com/150x150/fdfbe0/333?text=Dancow" class="product-img">
                <div class="product-info">
                    <div class="p-name">Dancow Coklat 780 g</div>
                    <div class="p-meta">1-2 hari | KAB. BEKASI</div>
                    <div class="p-qty">x1</div>
                </div>
                <div class="p-total-price">RP 131.000</div>
            </div>
            <div class="card-footer">
                <span class="total-label">Total Pesanan</span>
                <span class="total-value">RP 131.000,00</span>
            </div>
            <div class="btn-group">
                <a href="ulasan.html" class="btn btn-rate">Nilai Produk</a>
                <button class="btn btn-buy-again">Beli Lagi</button>
            </div>
        </div>

        <div class="history-card">
            <div class="card-header">
                <span><i class="fas fa-store"></i> Snap Shop Official</span>
                <span class="status-done"><i class="fas fa-check-circle"></i> Selesai</span>
            </div>
            <div class="card-body">
                <img src="https://via.placeholder.com/150x150/fdfbe0/333?text=Sarden" class="product-img">
                <div class="product-info">
                    <div class="p-name">Sarden Tomat ABC</div>
                    <div class="p-meta">1-2 hari | KAB. BEKASI</div>
                    <div class="p-qty">x1</div>
                </div>
                <div class="p-total-price">RP 14.000</div>
            </div>
            <div class="card-footer">
                <span class="total-label">Total Pesanan</span>
                <span class="total-value">RP 14.000,00</span>
            </div>
            <div class="btn-group">
                <a href="ulasan.html" class="btn btn-rate">Nilai Produk</a>
                <button class="btn btn-buy-again">Beli Lagi</button>
            </div>
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
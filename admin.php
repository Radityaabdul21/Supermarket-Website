<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap Shop - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #2E7D32;
            --light-green: #E8F5E9;
            --sidebar-bg: #ffffff;
            --bg-color: #F4F6F9;
            --text-dark: #333;
            --text-grey: #666;
            --border-color: #ddd;
            --danger-color: #d32f2f;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        
        body { background-color: var(--bg-color); display: flex; min-height: 100vh; }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            display: flex; flex-direction: column;
            position: fixed; height: 100%; top: 0; left: 0;
            z-index: 100;
        }

        .logo-area {
            padding: 20px;
            display: flex; align-items: center; gap: 10px;
            color: var(--primary-green); font-size: 20px; font-weight: bold;
            border-bottom: 1px solid var(--border-color);
        }

        .menu { flex-grow: 1; padding: 20px 0; }
        
        .menu-item {
            padding: 12px 20px;
            display: flex; align-items: center; gap: 15px;
            color: var(--text-grey); text-decoration: none;
            transition: 0.3s; cursor: pointer; border-left: 4px solid transparent;
        }

        .menu-item:hover, .menu-item.active {
            background-color: var(--light-green);
            color: var(--primary-green);
            border-left: 4px solid var(--primary-green);
        }

        /* Tombol Logout di Sidebar */
        .logout-btn {
            padding: 15px 20px;
            background-color: #ffebee;
            color: var(--danger-color);
            text-decoration: none;
            display: flex; align-items: center; gap: 10px;
            font-weight: bold; cursor: pointer;
            transition: 0.3s;
        }
        .logout-btn:hover { background-color: #ffcdd2; }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
        }

        /* Top Bar */
        .top-bar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 30px;
        }
        .page-title { font-size: 24px; font-weight: bold; color: var(--text-dark); }
        .admin-profile {
            display: flex; align-items: center; gap: 10px;
            background: white; padding: 8px 15px; border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        /* Sections */
        .section { display: none; animation: fadeIn 0.3s; }
        .section.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Cards & Tables */
        .card {
            background: white; border-radius: 8px; padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px;
        }

        .card-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;
        }
        .card-title { font-size: 18px; font-weight: bold; color: var(--text-dark); }

        .btn-add {
            background: var(--primary-green); color: white; border: none;
            padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px;
        }
        .btn-add:hover { opacity: 0.9; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { color: #555; font-size: 14px; background: #f9f9f9; }
        td { font-size: 14px; color: #333; }
        .product-img { width: 40px; height: 40px; border-radius: 5px; object-fit: cover; }
        
        .badge { padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; }
        .bg-success { background: #E8F5E9; color: #2E7D32; }
        .bg-warning { background: #FFF3E0; color: #EF6C00; }
        .bg-danger { background: #FFEBEE; color: #C62828; }

        .action-btn { border: none; background: none; cursor: pointer; font-size: 16px; margin-right: 5px; }
        .btn-edit { color: #1976D2; }
        .btn-delete { color: #d32f2f; }

        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 15px; }
        .stat-icon { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .icon-green { background: #E8F5E9; color: #2E7D32; }
        .icon-blue { background: #E3F2FD; color: #1565C0; }
        .icon-orange { background: #FFF3E0; color: #EF6C00; }
        .icon-red { background: #FFEBEE; color: #C62828; }
        .stat-info h3 { font-size: 24px; margin-bottom: 2px; }
        .stat-info p { font-size: 13px; color: #666; }

        /* --- CUSTOM LOGOUT ALERT STYLES (NEW) --- */
        .logout-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); z-index: 2000;
            display: none; justify-content: center; align-items: center;
            opacity: 0; transition: opacity 0.3s;
            backdrop-filter: blur(2px);
        }
        
        .logout-box {
            background: white; width: 350px; padding: 30px;
            border-radius: 15px; text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transform: scale(0.8); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .logout-overlay.show { display: flex; opacity: 1; }
        .logout-overlay.show .logout-box { transform: scale(1); }

        .logout-icon {
            width: 70px; height: 70px; background: #FFEBEE; color: var(--danger-color);
            border-radius: 50%; display: flex; justify-content: center; align-items: center;
            font-size: 30px; margin: 0 auto 20px auto;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(211, 47, 47, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(211, 47, 47, 0); }
            100% { box-shadow: 0 0 0 0 rgba(211, 47, 47, 0); }
        }

        .logout-title { font-size: 20px; font-weight: bold; color: #333; margin-bottom: 10px; }
        .logout-desc { font-size: 14px; color: #666; margin-bottom: 25px; }

        .logout-actions { display: flex; gap: 15px; justify-content: center; }
        
        .btn-modal {
            padding: 10px 25px; border-radius: 25px; font-weight: bold; cursor: pointer; border: none; font-size: 14px; transition: 0.2s;
        }
        .btn-cancel { background: #f0f0f0; color: #555; }
        .btn-cancel:hover { background: #e0e0e0; }
        
        .btn-confirm { background: var(--danger-color); color: white; box-shadow: 0 4px 10px rgba(211, 47, 47, 0.3); }
        .btn-confirm:hover { background: #b71c1c; transform: translateY(-2px); }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo-area">
            <i class="fas fa-shopping-bag"></i> Snap Admin
        </div>
        <div class="menu">
            <div class="menu-item active" onclick="showSection('dashboard', this)">
                <i class="fas fa-th-large"></i> Dashboard
            </div>
            <div class="menu-item" onclick="showSection('produk', this)">
                <i class="fas fa-box"></i> Data Produk
            </div>
            <div class="menu-item" onclick="showSection('pesanan', this)">
                <i class="fas fa-shopping-cart"></i> Data Pesanan
            </div>
            <div class="menu-item" onclick="showSection('pelanggan', this)">
                <i class="fas fa-users"></i> Data Pelanggan
            </div>
            <div class="menu-item" onclick="showSection('laporan', this)">
                <i class="fas fa-chart-line"></i> Laporan
            </div>
        </div>
        
        <div class="logout-btn" onclick="openLogoutModal()">
            <i class="fas fa-sign-out-alt"></i> Logout
        </div>
    </div>

    <div class="main-content">
        
        <div class="top-bar">
            <h2 class="page-title" id="pageTitle">Dashboard Overview</h2>
            <div class="admin-profile">
                <img src="https://via.placeholder.com/30" style="border-radius: 50%;">
                <span>Super Admin</span>
            </div>
        </div>

        <div id="dashboard" class="section active">
            <div class="stats-grid">
                <div class="stat-card"><div class="stat-icon icon-green"><i class="fas fa-wallet"></i></div><div class="stat-info"><h3>Rp 5.2Jt</h3><p>Pendapatan Hari Ini</p></div></div>
                <div class="stat-card"><div class="stat-icon icon-blue"><i class="fas fa-shopping-basket"></i></div><div class="stat-info"><h3>128</h3><p>Total Pesanan</p></div></div>
                <div class="stat-card"><div class="stat-icon icon-orange"><i class="fas fa-users"></i></div><div class="stat-info"><h3>45</h3><p>Pelanggan Baru</p></div></div>
                <div class="stat-card"><div class="stat-icon icon-red"><i class="fas fa-exclamation-triangle"></i></div><div class="stat-info"><h3>5</h3><p>Stok Menipis</p></div></div>
            </div>
            <div class="card">
                <div class="card-header"><div class="card-title">Pesanan Terbaru</div></div>
                <table>
                    <thead><tr><th>ID Order</th><th>Pelanggan</th><th>Barang</th><th>Total</th><th>Status</th></tr></thead>
                    <tbody>
                        <tr><td>#ORD-001</td><td>Budi Santoso</td><td>Minyak Goreng, Beras</td><td>Rp 85.000</td><td><span class="badge bg-success">Selesai</span></td></tr>
                        <tr><td>#ORD-002</td><td>Siti Aminah</td><td>Susu Pediasure</td><td>Rp 280.000</td><td><span class="badge bg-warning">Proses</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="produk" class="section">
            <div class="card">
                <div class="card-header"><div class="card-title">Daftar Produk</div><button class="btn-add"><i class="fas fa-plus"></i> Tambah Produk</button></div>
                <table>
                    <thead><tr><th>Gambar</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td><img src="https://via.placeholder.com/40" class="product-img"></td><td>Susu Dancow</td><td>Minuman</td><td>Rp 131.000</td><td>50</td><td><button class="action-btn btn-edit"><i class="fas fa-edit"></i></button><button class="action-btn btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                        <tr><td><img src="https://via.placeholder.com/40" class="product-img"></td><td>Sarden ABC</td><td>Makanan Kaleng</td><td>Rp 14.000</td><td>120</td><td><button class="action-btn btn-edit"><i class="fas fa-edit"></i></button><button class="action-btn btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="pesanan" class="section">
            <div class="card">
                <div class="card-header"><div class="card-title">Kelola Pesanan</div></div>
                <table>
                    <thead><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Metode</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <tr><td>#ORD-882</td><td>28 Des 2025</td><td>Ahmad Dhani</td><td>QRIS</td><td><span class="badge bg-warning">Dikemas</span></td><td><button class="action-btn btn-edit"><i class="fas fa-eye"></i></button></td></tr>
                        <tr><td>#ORD-881</td><td>27 Des 2025</td><td>Luna Maya</td><td>COD</td><td><span class="badge bg-success">Dikirim</span></td><td><button class="action-btn btn-edit"><i class="fas fa-eye"></i></button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="pelanggan" class="section">
            <div class="card">
                <div class="card-header"><div class="card-title">Data Pelanggan</div></div>
                <table>
                    <thead><tr><th>Nama</th><th>Email</th><th>No. Telepon</th><th>Bergabung</th><th>Total Belanja</th></tr></thead>
                    <tbody>
                        <tr><td>Raditya</td><td>raditya@gmail.com</td><td>08123456789</td><td>20 Nov 2025</td><td>Rp 1.500.000</td></tr>
                        <tr><td>Budi Santoso</td><td>budi@gmail.com</td><td>08987654321</td><td>15 Des 2025</td><td>Rp 85.000</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="laporan" class="section">
            <div class="stats-grid">
                <div class="stat-card" style="background: #2E7D32; color: white;">
                    <div class="stat-info"><h3>Rp 150.000.000</h3><p style="color: #e8f5e9;">Total Omset Bulan Ini</p></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><div class="card-title">Grafik Penjualan</div></div>
                <div style="display: flex; align-items: flex-end; height: 200px; gap: 10px; padding-top: 20px;">
                    <div style="width: 10%; background: #ddd; height: 40%; border-radius: 5px 5px 0 0; position: relative;"><span style="position:absolute; bottom:-20px; font-size:10px; width:100%; text-align:center;">Sen</span></div>
                    <div style="width: 10%; background: #AED581; height: 60%; border-radius: 5px 5px 0 0; position: relative;"><span style="position:absolute; bottom:-20px; font-size:10px; width:100%; text-align:center;">Sel</span></div>
                    <div style="width: 10%; background: #2E7D32; height: 80%; border-radius: 5px 5px 0 0; position: relative;"><span style="position:absolute; bottom:-20px; font-size:10px; width:100%; text-align:center;">Rab</span></div>
                    <div style="width: 10%; background: #AED581; height: 50%; border-radius: 5px 5px 0 0; position: relative;"><span style="position:absolute; bottom:-20px; font-size:10px; width:100%; text-align:center;">Kam</span></div>
                    <div style="width: 10%; background: #2E7D32; height: 90%; border-radius: 5px 5px 0 0; position: relative;"><span style="position:absolute; bottom:-20px; font-size:10px; width:100%; text-align:center;">Jum</span></div>
                    <div style="width: 10%; background: #AED581; height: 70%; border-radius: 5px 5px 0 0; position: relative;"><span style="position:absolute; bottom:-20px; font-size:10px; width:100%; text-align:center;">Sab</span></div>
                    <div style="width: 10%; background: #2E7D32; height: 95%; border-radius: 5px 5px 0 0; position: relative;"><span style="position:absolute; bottom:-20px; font-size:10px; width:100%; text-align:center;">Min</span></div>
                </div>
            </div>
        </div>

    </div>

    <div class="logout-overlay" id="logoutModal">
        <div class="logout-box">
            <div class="logout-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <div class="logout-title">Konfirmasi Logout</div>
            <div class="logout-desc">Apakah Anda yakin ingin keluar dari halaman admin?</div>
            <div class="logout-actions">
                <button class="btn-modal btn-cancel" onclick="closeLogoutModal()">Batal</button>
                <button class="btn-modal btn-confirm" onclick="confirmLogout()">Ya, Keluar</button>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId, element) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(sec => sec.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');

            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active'));
            if(element) {
                element.classList.add('active');
                document.getElementById('pageTitle').innerText = element.innerText.trim();
            }
        }

        // --- FUNGSI MODAL LOGOUT ---
        function openLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('show'), 10);
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }

        function confirmLogout() {
            // Animasi tombol sebentar
            const btn = document.querySelector('.btn-confirm');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 800);
        }
    </script>

</body>
</html>
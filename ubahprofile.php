<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Profil - Snap Shop</title>
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
        
        .form-group:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 15px 30px rgba(85, 139, 47, 0.25); 
        }

        .label { 
            font-weight: bold; font-size: 13px; color: #888; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px;
        }
        
        .input-field {
            background: transparent; border: none; outline: none;
            font-size: 16px; color: #333; width: 100%; font-weight: 600;
            border-bottom: 1px solid transparent; transition: 0.3s;
        }
        .input-field:focus { border-bottom: 1px solid var(--primary-green); }

        /* Khusus Foto */
        .photo-group {
            flex-direction: row; justify-content: space-between; align-items: center; cursor: pointer;
            background: linear-gradient(to right, #ffffff, #f9fbe7); /* Sedikit gradasi di card foto */
        }
        .photo-wrapper { position: relative; }
        .photo-preview {
            width: 60px; height: 60px; border-radius: 50%; object-fit: cover;
            border: 3px solid var(--primary-green); padding: 2px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s;
        }
        .photo-group:hover .photo-preview { transform: scale(1.1) rotate(5deg); }
        .edit-icon {
            position: absolute; bottom: 0; right: 0; background: var(--primary-green); color: white;
            border-radius: 50%; width: 20px; height: 20px; font-size: 10px;
            display: flex; align-items: center; justify-content: center; border: 2px solid white;
        }

        /* Khusus Gender (Animated Pills) */
        .gender-options { display: flex; gap: 15px; margin-top: 10px; }
        .radio-label { 
            display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; font-weight: bold; 
            background: #f0f0f0; padding: 10px 20px; border-radius: 25px; transition: 0.3s; color: #555;
            border: 1px solid transparent;
        }
        /* Hide default radio */
        input[type="radio"] { display: none; }
        /* Style saat dipilih */
        input[type="radio"]:checked + span { color: white; }
        .radio-label:has(input:checked) {
            background: var(--primary-green); color: white; box-shadow: 0 5px 15px rgba(85, 139, 47, 0.3); transform: scale(1.05);
        }

        /* Tombol Simpan Keren */
        .btn-save {
            background: linear-gradient(to right, #558B2F, #8BC34A);
            color: white; width: 100%; padding: 16px; border: none; border-radius: 30px; 
            font-size: 16px; font-weight: bold; letter-spacing: 1px;
            cursor: pointer; margin-top: 30px; 
            box-shadow: 0 10px 20px rgba(85, 139, 47, 0.3);
            transition: 0.3s; position: relative; overflow: hidden;
        }
        .btn-save:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 15px 25px rgba(85, 139, 47, 0.4); 
        }
        .btn-save:active { transform: scale(0.98); }

    </style>
</head>
<body>

    <div class="overlay" id="overlay"></div>
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-close" id="closeSidebar">&times;</div>
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="position: relative; display: inline-block;">
                <img src="https://via.placeholder.com/100" id="sidebarPhoto" style="width: 80px; height: 80px; border-radius: 50%; border: 3px solid var(--primary-green); padding: 2px;">
            </div>
            <p style="margin-top: 15px; font-weight: bold; font-size: 18px;">Nama Akun</p>
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
        <div class="nav-left" id="openSidebar">
            <i class="fas fa-bars"></i>
        </div>
        <div class="page-title">Ubah Profile</div>
    </header>

    <div class="container">
        
        <div class="form-group photo-group" onclick="document.getElementById('fileInput').click()">
            <div>
                <div class="label" style="color: var(--primary-green);">Foto Profil</div>
                <div style="font-size: 12px; color: #555;">Ketuk untuk mengganti foto</div>
            </div>
            <div class="photo-wrapper">
                <img src="https://via.placeholder.com/100" id="profilePreview" class="photo-preview">
                <div class="edit-icon"><i class="fas fa-camera"></i></div>
            </div>
            <input type="file" id="fileInput" hidden accept="image/*" onchange="previewImage(this)">
        </div>

        <div class="form-group">
            <div class="label">No. Telepon</div>
            <input type="tel" class="input-field" placeholder="08xxxxxxxxxx">
        </div>

        <div class="form-group">
            <div class="label">Tanggal Lahir</div>
            <input type="date" class="input-field" value="2000-01-01">
        </div>

        <div class="form-group" style="border-left: none; padding-bottom: 25px;">
            <div class="label">Jenis Kelamin</div>
            <div class="gender-options">
                <label class="radio-label">
                    <input type="radio" name="gender" value="Laki-laki" checked>
                    <span><i class="fas fa-mars"></i> Laki-laki</span>
                </label>
                <label class="radio-label">
                    <input type="radio" name="gender" value="Perempuan">
                    <span><i class="fas fa-venus"></i> Perempuan</span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="label">Domisili</div>
            <div style="position: relative;">
                <select class="input-field" style="background: transparent;">
                    <option>Pilih Kota Anda...</option>
                    <option>Jakarta</option>
                    <option>Bogor</option>
                    <option>Depok</option>
                    <option>Tangerang</option>
                    <option>Bekasi</option>
                    <option>Bandung</option>
                    <option>Surabaya</option>
                </select>
                <i class="fas fa-chevron-down" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); pointer-events: none; color: var(--primary-green);"></i>
            </div>
        </div>

        <button class="btn-save" onclick="simpanProfil()">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>

    </div>

    <script>
        // 1. Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openSidebar');
        const closeSideBtn = document.getElementById('closeSidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        openBtn.addEventListener('click', toggleSidebar);
        closeSideBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // 2. Preview Image Logic (Update Sidebar Juga)
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                    // Update foto di sidebar juga biar keren
                    document.getElementById('sidebarPhoto').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // 3. Simpan Profil (Simulasi)
        function simpanProfil() {
            const btn = document.querySelector('.btn-save');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            btn.style.opacity = '0.8';
            
            setTimeout(() => {
                alert("Profil berhasil diperbarui!");
                btn.innerHTML = originalText;
                btn.style.opacity = '1';
                window.location.href = 'beranda.html';
            }, 1500);
        }
    </script>

</body>
</html>
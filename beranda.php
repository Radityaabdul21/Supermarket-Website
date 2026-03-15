<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap Shop - Beranda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #558B2F; 
            --light-cream: #FDFBE0;   
            --text-dark: #333;
            --danger: #d32f2f;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

        body {
            background-color: var(--light-cream);
            padding-bottom: 80px; 
            overflow-x: hidden; /* Mencegah scroll horizontal halaman */
        }

        /* --- 1. HEADER & SEARCH BAR FIX --- */
        .navbar {
            background-color: var(--primary-green);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 1000;
            color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .nav-left { display: flex; align-items: center; gap: 15px; }
        .menu-btn { cursor: pointer; font-size: 24px; }
        .logo { font-weight: bold; font-size: 20px; display: flex; align-items: center; gap: 8px; }
        
        /* Search Bar Baru yang Lebih Rapi */
        .search-bar {
            flex-grow: 1;
            margin: 0 20px;
            background: white;
            border-radius: 5px;
            display: flex;
            overflow: hidden; /* Agar tombol tidak keluar border */
            max-width: 600px;
        }
        
        .search-bar input {
            width: 100%;
            padding: 10px 15px;
            border: none;
            outline: none;
            font-size: 14px;
        }
        
        .search-btn {
            background: #467022;
            color: white;
            border: none;
            padding: 0 20px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.2s;
        }
        .search-btn:hover { background: #2E5215; }

        .nav-right { display: flex; gap: 20px; align-items: center; }
        .nav-right a { color: white; text-decoration: none; position: relative; }

        /* Badge Keranjang */
        .cart-badge {
            position: absolute; top: -8px; right: -8px;
            background: var(--danger); color: white;
            font-size: 10px; padding: 2px 6px; border-radius: 50%;
            display: none;
        }
        .cart-badge.show { display: block; }


        /* Sidebar Style */
        .sidebar { position: fixed; left: -280px; top: 0; height: 100%; width: 250px; background: white; z-index: 2000; transition: 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55); box-shadow: 5px 0 20px rgba(0,0,0,0.1); padding-top: 60px; }
        .sidebar.active { left: 0; }
        .sidebar-close { position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; color: var(--primary-green); }
        .sidebar a { padding: 15px 20px; text-decoration: none; font-size: 16px; color: #333; display: flex; align-items: center; gap: 15px; border-bottom: 1px solid #f0f0f0; transition: 0.3s; }
        .sidebar a:hover { background-color: #f1f8e9; color: var(--primary-green); padding-left: 25px; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1500; display: none; backdrop-filter: blur(3px); }
        .overlay.active { display: block; }

        /* --- 2. KATEGORI BARU (BERWARNA & GESER) --- */
        .section-title {
            padding: 0 20px; margin-top: 20px; margin-bottom: 10px;
            font-weight: bold; color: var(--primary-green); font-size: 18px; text-transform: uppercase;
        }

        .category-scroll {
            display: flex;
            overflow-x: auto;
            padding: 10px 20px;
            gap: 15px;
            scrollbar-width: none; /* Hide scrollbar Firefox */
        }
        .category-scroll::-webkit-scrollbar { display: none; } /* Hide Chrome */

        .cat-btn {
            min-width: 90px;
            height: 90px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
            transition: transform 0.2s;
            text-align: center;
            padding: 5px;
        }
        .cat-btn:hover { transform: translateY(-5px); }
        .cat-btn i { font-size: 28px; margin-bottom: 8px; }

        /* Warna Kategori */
        .bg-blue { background-color: #42A5F5; }
        .bg-green { background-color: #AED581; }
        .bg-orange { background-color: #FFB74D; }
        .bg-brown { background-color: #D7CCC8; color: #5D4037; }
        .bg-purple { background-color: #BA68C8; }
        .bg-yellow { background-color: #FFF176; color: #333; }
        .bg-grey { background-color: #90A4AE; }
        .bg-peach { background-color: #FF8A65; }
        .bg-red { background-color: #EF5350; }

        /* --- PRODUCT GRID --- */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 15px;
            padding: 0 20px 20px 20px;
        }
        .product-card {
            background: white; border-radius: 10px; padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); position: relative;
        }
        .product-img { width: 100%; height: 140px; background: #eee; border-radius: 5px; object-fit: contain; margin-bottom: 10px; }
        .p-title { font-size: 14px; font-weight: bold; margin-bottom: 5px; }
        .p-price { color: var(--primary-green); font-weight: bold; }
        .p-actions { display: flex; justify-content: space-between; margin-top: 10px; color: #aaa; align-items: center; }

        /* --- FLASH SALE --- */
        .flash-sale-container {
            margin: 20px; background: white; border-radius: 10px; overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1); position: relative;
        }
        .flash-slider-wrapper { display: flex; transition: transform 0.5s ease-in-out; }
        .flash-slide { min-width: 100%; padding: 20px; display: flex; align-items: center; gap: 15px; }
        .fs-image { width: 40%; } .fs-image img { width: 100%; }
        .fs-info { width: 60%; }
        .fs-btn { background: var(--primary-green); color: white; border: none; padding: 8px 15px; border-radius: 5px; width: 100%; cursor: pointer; }
        .slider-dots { position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); display: flex; gap: 5px; }
        .dot { width: 8px; height: 8px; background: #ddd; border-radius: 50%; } .dot.active { background: var(--primary-green); }

        /* --- 3. ROLLING BANNER (MARQUEE CEPAT) --- */
        .rolling-banner-container {
            background: var(--primary-green); 
            padding: 15px 0;
            overflow: hidden;
            white-space: nowrap;
            margin-top: 20px;
            position: relative;
        }

        .marquee-content {
            display: inline-block;
            /* Animasi dipercepat (10s) dan infinite */
            animation: marquee 10s linear infinite; 
        }

        .marquee-item {
            display: inline-block;
            width: 100px;
            height: 120px;
            background: white; 
            margin: 0 10px;
            border-radius: 10px;
            overflow: hidden;
            vertical-align: middle;
        }
        .marquee-item img { width: 100%; height: 100%; object-fit: contain; padding: 5px; }

        /* Keyframes: Gerak dari Kanan (0) ke Kiri (-100%) */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); } 
        }

        /* Animasi Terbang ke Cart */
        .fly-item {
            position: fixed; z-index: 9999; width: 30px; height: 30px;
            background: var(--primary-green); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; pointer-events: none; transition: all 0.8s cubic-bezier(0.19, 1, 0.22, 1);
        }

        /* MODAL PROMO */
        .promo-modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 3000; display: flex; justify-content: center; align-items: center; visibility: hidden; opacity: 0; transition: 0.3s; }
        .promo-modal.show { visibility: visible; opacity: 1; }
        .modal-content { position: relative; width: 90%; max-width: 400px; }
        .modal-content img { width: 100%; border-radius: 10px; }
        .close-modal { position: absolute; top: -15px; right: -15px; background: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer; border: 2px solid var(--primary-green); }

    </style>
</head>
<body>

    <div class="overlay" id="overlay"></div>
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-close" id="closeSidebar">&times;</div>
        <div style="text-align: center; margin-bottom: 20px;">
            <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i>
            <p style="margin-top: 10px; font-weight: bold;">Raditya</p>
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

    <div class="promo-modal" id="promoModal">
        <div class="modal-content">
            <div class="close-modal" id="closeModal">&times;</div>
            <img src="https://via.placeholder.com/400x250/d32f2f/ffffff?text=PROMO+HEBOH" alt="Promo">
        </div>
    </div>

    <header class="navbar">
        <div class="nav-left">
            <i class="fas fa-bars menu-btn" id="openSidebar"></i>
            <div class="logo">
                <i class="fas fa-shopping-bag"></i> Snap Shop
            </div>
        </div>
        
        <div class="search-bar">
            <input type="text" placeholder="Cari barang...">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>

        <div class="nav-right">
            <a href="keranjang.html" style="position: relative;">
                <i class="fas fa-shopping-cart" style="font-size: 22px;"></i>
                <span class="cart-badge" id="cartBadge">0</span>
            </a>
            <i class="fas fa-user-circle" style="font-size: 24px;"></i>
        </div>
    </header>

    <div class="section-title">KATEGORI BELANJA</div>
    <div class="category-scroll">
        <a href="Kategori.html" class="cat-btn bg-blue">
            <i class="fas fa-fish"></i> Makanan Kaleng
        </a>
        <a href="Kategori.html" class="cat-btn bg-green">
            <i class="fas fa-carrot"></i> Sayuran
        </a>
        <a href="Kategori.html" class="cat-btn bg-orange">
            <i class="fas fa-cookie-bite"></i> Cemilan
        </a>
        <a href="Kategori.html" class="cat-btn bg-brown">
            <i class="fas fa-chocolate"></i> Coklat
        </a>
        <a href="Kategori.html" class="cat-btn bg-blue">
            <i class="fas fa-candy-cane"></i> Permen
        </a>
        <a href="Kategori.html" class="cat-btn bg-brown">
            <i class="fas fa-bread-slice"></i> Roti
        </a>
        <a href="Kategori.html" class="cat-btn bg-yellow">
            <i class="fas fa-utensils"></i> Mie
        </a>
        <a href="Kategori.html" class="cat-btn bg-grey">
            <i class="fas fa-snowflake"></i> Frozen Food
        </a>
        <a href="Kategori.html" class="cat-btn bg-peach">
            <i class="fas fa-apple-alt"></i> Buah
        </a>
        <a href="Kategori.html" class="cat-btn bg-red">
            <i class="fas fa-drumstick-bite"></i> Daging
        </a>
    </div>

    <div class="section-title">REKOMENDASI</div>
    <div class="product-grid">
        <div class="product-card">
            <img src="https://via.placeholder.com/150" class="product-img" alt="Produk">
            <div class="p-title">Minyak Goreng</div>
            <div class="p-price">Rp 29.900</div>
            <div class="p-actions">
                <i class="far fa-heart"></i>
                <i class="fas fa-plus-circle add-to-cart-btn" style="color:var(--primary-green); cursor: pointer; font-size: 20px;"
                   data-id="p1" data-name="Minyak Goreng" data-price="29900" data-img="https://via.placeholder.com/150"></i>
            </div>
        </div>
        <div class="product-card">
            <img src="https://via.placeholder.com/150" class="product-img" alt="Produk">
            <div class="p-title">Deterjen Cair</div>
            <div class="p-price">Rp 15.000</div>
            <div class="p-actions">
                <i class="far fa-heart"></i>
                <i class="fas fa-plus-circle add-to-cart-btn" style="color:var(--primary-green); cursor: pointer; font-size: 20px;"
                   data-id="p2" data-name="Deterjen Cair" data-price="15000" data-img="https://via.placeholder.com/150"></i>
            </div>
        </div>
    </div>

    <div class="flash-sale-container">
        <div class="flash-slider-wrapper" id="flashWrapper">
            <div class="flash-slide">
                <div class="fs-image"><img src="https://via.placeholder.com/150x200/512da8/ffffff?text=Pediasure" alt="Pediasure"></div>
                <div class="fs-info">
                    <p style="font-size: 12px; color: #666;">Flash Sale Hari Ini</p>
                    <div class="fs-title">Pediasure Chocolate</div>
                    <div class="fs-price-old">Rp 310.000</div>
                    <div class="fs-price-new">Rp 280.000</div>
                    <button class="fs-btn">Beli Sekarang</button>
                </div>
            </div>
            <div class="flash-slide">
                <div class="fs-image"><img src="https://via.placeholder.com/150x200/d32f2f/ffffff?text=Minyak" alt="Minyak"></div>
                <div class="fs-info">
                    <p style="font-size: 12px; color: #666;">Flash Sale Hari Ini</p>
                    <div class="fs-title">Minyak Goreng 2L</div>
                    <div class="fs-price-old">Rp 45.000</div>
                    <div class="fs-price-new">Rp 29.900</div>
                    <button class="fs-btn">Beli Sekarang</button>
                </div>
            </div>
        </div>
        <div class="slider-dots">
            <div class="dot active"></div>
            <div class="dot"></div>
        </div>
    </div>

    <div class="rolling-banner-container">
        <div class="marquee-content">
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Doritos" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Lays" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Chitato" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Qtela" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Milo" alt="Ad"></div>
            
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Doritos" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Lays" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Chitato" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Qtela" alt="Ad"></div>
            <div class="marquee-item"><img src="https://via.placeholder.com/100x120?text=Milo" alt="Ad"></div>
        </div>
    </div>

    <script>
        // 1. Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openSidebar');
        const closeSideBtn = document.getElementById('closeSidebar');

        function toggleSidebar() { sidebar.classList.toggle('active'); overlay.classList.toggle('active'); }
        openBtn.addEventListener('click', toggleSidebar);
        closeSideBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // 2. Promo Modal
        window.addEventListener('load', () => {
            const modal = document.getElementById('promoModal');
            const closeBtn = document.getElementById('closeModal');
            setTimeout(() => { modal.classList.add('show'); }, 1000);
            closeBtn.addEventListener('click', () => { modal.classList.remove('show'); });
            updateCartBadge(); // Cek badge keranjang
        });

        // 3. Flash Sale Slider
        let slideIndex = 0;
        const slides = document.querySelectorAll('.flash-slide');
        const wrapper = document.getElementById('flashWrapper');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            slideIndex = index;
            wrapper.style.transform = `translateX(-${slideIndex * 100}%)`;
            dots.forEach(dot => dot.classList.remove('active'));
            dots[slideIndex].classList.add('active');
        }

        setInterval(() => {
            slideIndex++;
            if (slideIndex >= slides.length) slideIndex = 0;
            showSlide(slideIndex);
        }, 3000);

        // 4. Cart Badge & Animation
        function updateCartBadge() {
            const cart = JSON.parse(localStorage.getItem('snapShopCart')) || [];
            const badge = document.getElementById('cartBadge');
            const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
            badge.innerText = totalItems;
            if (totalItems > 0) badge.classList.add('show'); else badge.classList.remove('show');
        }

        function addToCartClick(event) {
            const btn = event.target;
            const product = {
                id: btn.getAttribute('data-id'),
                name: btn.getAttribute('data-name'),
                price: parseInt(btn.getAttribute('data-price')),
                img: btn.getAttribute('data-img'),
                qty: 1
            };

            const flyer = document.createElement('div');
            flyer.classList.add('fly-item');
            flyer.innerHTML = '<i class="fas fa-plus"></i>';
            document.body.appendChild(flyer);

            const startPos = btn.getBoundingClientRect();
            const endPos = document.querySelector('.fa-shopping-cart').getBoundingClientRect();

            flyer.style.left = startPos.left + 'px'; flyer.style.top = startPos.top + 'px';

            setTimeout(() => {
                flyer.style.left = (endPos.left + 10) + 'px'; flyer.style.top = (endPos.top + 10) + 'px';
                flyer.style.opacity = '0'; flyer.style.transform = 'scale(0.5)';
            }, 50);

            setTimeout(() => {
                document.body.removeChild(flyer);
                let cart = JSON.parse(localStorage.getItem('snapShopCart')) || [];
                const existingItem = cart.find(item => item.id === product.id);
                if (existingItem) existingItem.qty++; else cart.push(product);
                localStorage.setItem('snapShopCart', JSON.stringify(cart));
                updateCartBadge();
            }, 800);
        }

        const addBtns = document.querySelectorAll('.add-to-cart-btn');
        addBtns.forEach(btn => btn.addEventListener('click', addToCartClick));
    </script>
</body>
</html>
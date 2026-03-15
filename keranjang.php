<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap Shop - Keranjang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --header-green: #9CCC65;
            --primary-green: #558B2F;
            --bg-color: #f4f4f4;
            --text-dark: #333;
            --danger: #d32f2f;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); padding-bottom: 100px; }

        /* --- HEADER & SIDEBAR CSS (Sama dengan Kategori) --- */
        .navbar {
            background-color: var(--header-green);
            padding: 15px 20px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            color: white;
        }
        .nav-left { display: flex; align-items: center; gap: 15px; font-size: 20px; cursor: pointer; }
        .search-container { flex-grow: 1; margin: 0 20px; display: flex; max-width: 600px; }
        .search-input { width: 100%; padding: 10px 15px; border: none; border-radius: 5px 0 0 5px; outline: none; }
        .search-btn { background: #558B2F; color: white; border: none; padding: 0 15px; border-radius: 0 5px 5px 0; cursor: pointer; }
        .nav-right { display: flex; align-items: center; gap: 20px; position: relative; }
        .user-profile { display: flex; align-items: center; gap: 8px; }

   
        /* Sidebar Style */
        .sidebar { position: fixed; left: -280px; top: 0; height: 100%; width: 250px; background: white; z-index: 2000; transition: 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55); box-shadow: 5px 0 20px rgba(0,0,0,0.1); padding-top: 60px; }
        .sidebar.active { left: 0; }
        .sidebar-close { position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; color: var(--primary-green); }
        .sidebar a { padding: 15px 20px; text-decoration: none; font-size: 16px; color: #333; display: flex; align-items: center; gap: 15px; border-bottom: 1px solid #f0f0f0; transition: 0.3s; }
        .sidebar a:hover { background-color: #f1f8e9; color: var(--primary-green); padding-left: 25px; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1500; display: none; backdrop-filter: blur(3px); }
        .overlay.active { display: block; }

        /* --- CART CONTENT --- */
        .container { max-width: 800px; margin: 20px auto; padding: 0 15px; }

        .cart-item {
            background: white; border-radius: 10px; padding: 15px; margin-bottom: 15px;
            display: flex; align-items: center; position: relative;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); border: 1px solid #eee;
        }
        .item-checkbox { width: 20px; height: 20px; cursor: pointer; margin-right: 15px; accent-color: var(--primary-green); }
        .item-img-box { width: 80px; height: 80px; border: 1px solid #ddd; border-radius: 5px; display: flex; align-items: center; justify-content: center; padding: 5px; margin-right: 15px; }
        .item-img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .item-details { flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; height: 80px; }
        .item-top { display: flex; justify-content: space-between; align-items: flex-start; }
        .item-name { font-weight: bold; font-size: 14px; color: #333; max-width: 80%; }
        .item-heart { color: var(--danger); font-size: 18px; cursor: pointer; }
        .item-price { font-weight: bold; color: var(--primary-green); font-size: 16px; text-align: right; margin-bottom: 5px; }

        .qty-control { display: flex; align-items: center; margin-top: auto; }
        .qty-btn { width: 30px; height: 30px; border: none; color: white; font-weight: bold; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
        .qty-minus { background-color: var(--danger); border-top-left-radius: 5px; border-bottom-left-radius: 5px; }
        .qty-plus { background-color: var(--primary-green); border-top-right-radius: 5px; border-bottom-right-radius: 5px; }
        .qty-input { width: 40px; height: 30px; text-align: center; border: 1px solid #ddd; border-left: none; border-right: none; font-weight: bold; outline: none; }

        /* --- FOOTER TOTAL --- */
        .cart-footer {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: white; padding: 15px 20px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 -4px 10px rgba(0,0,0,0.1); z-index: 900;
        }
        .total-text { font-size: 14px; color: #333; font-weight: bold;}
        .total-amount { font-size: 20px; color: var(--primary-green); font-weight: bold; margin-left: 10px; }
        
        .checkout-btn {
            background: var(--primary-green); color: white; border: none;
            padding: 12px 40px; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer;
            transition: 0.3s;
        }
        .checkout-btn:hover { background: #3e6b1e; }
        
        .empty-msg { text-align: center; margin-top: 50px; color: #999; }
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
        <div class="nav-left" id="openSidebar">
            <i class="fas fa-bars"></i>
        </div>
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search.....">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>
        <div class="nav-right">
            <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
            <div class="user-profile"><i class="fas fa-user-circle" style="font-size: 24px;"></i> <span>nama akun</span></div>
        </div>
    </header>

    <div class="container" id="cartContainer">
        </div>

    <div class="cart-footer">
        <div>
            <span class="total-text" id="totalLabel">Total (0 Produk)</span>
            <span class="total-amount" id="totalPrice">RP 0</span>
        </div>
        <button class="checkout-btn" onclick="goToCheckout()">Pesan</button>
    </div>

    <script>
        // --- 1. SIDEBAR LOGIC ---
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('openSidebar');
        const closeSideBtn = document.getElementById('closeSidebar');

        function toggleSidebar() { sidebar.classList.toggle('active'); overlay.classList.toggle('active'); }
        openBtn.addEventListener('click', toggleSidebar);
        closeSideBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // --- 2. LOGIKA KERANJANG ---
        function formatRupiah(angka) {
            return 'RP ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function renderCart() {
            const cartContainer = document.getElementById('cartContainer');
            const totalLabel = document.getElementById('totalLabel');
            const totalPriceEl = document.getElementById('totalPrice');
            
            let cart = JSON.parse(localStorage.getItem('snapShopCart')) || [];

            if (cart.length === 0) {
                cartContainer.innerHTML = '<div class="empty-msg"><i class="fas fa-shopping-cart" style="font-size: 50px; margin-bottom: 20px;"></i><br>Keranjang kosong</div>';
                totalLabel.innerText = 'Total (0 Produk)';
                totalPriceEl.innerText = 'RP 0';
                return;
            }

            cartContainer.innerHTML = '';
            let grandTotal = 0;
            let totalItems = 0;

            cart.forEach((item, index) => {
                const itemTotal = item.price * item.qty;
                grandTotal += itemTotal;
                totalItems += item.qty;

                const cartItemHTML = `
                    <div class="cart-item">
                        <input type="checkbox" class="item-checkbox" checked>
                        <div class="item-img-box"><img src="${item.img}" class="item-img" alt="${item.name}"></div>
                        <div class="item-details">
                            <div class="item-top">
                                <div class="item-name">${item.name}</div>
                                <i class="far fa-heart item-heart"></i>
                            </div>
                            <div class="item-price">${formatRupiah(item.price)},00</div>
                            <div class="qty-control">
                                <button class="qty-btn qty-minus" onclick="changeQty(${index}, -1)">-</button>
                                <input type="text" class="qty-input" value="${item.qty}" readonly>
                                <button class="qty-btn qty-plus" onclick="changeQty(${index}, 1)">+</button>
                            </div>
                        </div>
                    </div>
                `;
                cartContainer.innerHTML += cartItemHTML;
            });

            totalLabel.innerText = `Total ( ${totalItems} Produk)`;
            totalPriceEl.innerText = formatRupiah(grandTotal) + ',00';
        }

        function changeQty(index, change) {
            let cart = JSON.parse(localStorage.getItem('snapShopCart')) || [];
            cart[index].qty += change;
            if (cart[index].qty <= 0) {
                if(confirm("Hapus produk ini?")) cart.splice(index, 1);
                else cart[index].qty = 1;
            }
            localStorage.setItem('snapShopCart', JSON.stringify(cart));
            renderCart();
        }

        // --- 3. LOGIKA TOMBOL PESAN (Checkout) ---
        function goToCheckout() {
            let cart = JSON.parse(localStorage.getItem('snapShopCart')) || [];
            
            if(cart.length === 0) {
                alert("Keranjang Anda masih kosong. Silakan belanja dulu!");
                return;
            }

            // Pindah ke halaman checkout barang
            window.location.href = 'checkout barang.html';
        }

        document.addEventListener('DOMContentLoaded', renderCart);
    </script>
</body>
</html>
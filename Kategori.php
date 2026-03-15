<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap Shop - Kategori</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* --- CSS SAMA SEPERTI SEBELUMNYA --- */
        :root { --header-green: #9CCC65; --bg-color: #FAFAFA; --text-dark: #333; --price-green: #2E7D32; --primary-green: #558B2F; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); padding-bottom: 50px; }
        .navbar { background-color: var(--header-green); padding: 15px 20px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .nav-left { display: flex; align-items: center; gap: 15px; color: white; font-size: 20px; cursor: pointer; }
        .search-container { flex-grow: 1; margin: 0 20px; display: flex; max-width: 600px; }
        .search-input { width: 100%; padding: 10px 15px; border: none; border-radius: 5px 0 0 5px; outline: none; }
        .search-btn { background: #558B2F; color: white; border: none; padding: 0 15px; border-radius: 0 5px 5px 0; cursor: pointer; }
        .nav-right { display: flex; align-items: center; gap: 20px; color: white; position: relative; }
        .user-profile { display: flex; align-items: center; gap: 8px; cursor: pointer; }
        .cart-icon-container { position: relative; color: white; text-decoration: none; }
        .cart-badge { position: absolute; top: -8px; right: -10px; background-color: #d32f2f; color: white; font-size: 10px; font-weight: bold; padding: 2px 6px; border-radius: 50%; display: none; }
        .cart-badge.show { display: block; }
           /* Sidebar Style */
        .sidebar { position: fixed; left: -280px; top: 0; height: 100%; width: 250px; background: white; z-index: 2000; transition: 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55); box-shadow: 5px 0 20px rgba(0,0,0,0.1); padding-top: 60px; }
        .sidebar.active { left: 0; }
        .sidebar-close { position: absolute; top: 15px; right: 20px; font-size: 24px; cursor: pointer; color: var(--primary-green); }
        .sidebar a { padding: 15px 20px; text-decoration: none; font-size: 16px; color: #333; display: flex; align-items: center; gap: 15px; border-bottom: 1px solid #f0f0f0; transition: 0.3s; }
        .sidebar a:hover { background-color: #f1f8e9; color: var(--primary-green); padding-left: 25px; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1500; display: none; backdrop-filter: blur(3px); }
        .overlay.active { display: block; }
        .container { padding: 20px; max-width: 1200px; margin: 0 auto; }
        .page-title { color: #558B2F; font-size: 24px; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; }
        .category-filter-scroll { display: flex; gap: 15px; overflow-x: auto; padding-bottom: 10px; margin-bottom: 30px; scrollbar-width: none; }
        .category-filter-scroll::-webkit-scrollbar { display: none; }
        .cat-btn { min-width: 90px; height: 90px; border-radius: 10px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; font-size: 14px; font-weight: bold; cursor: pointer; transition: transform 0.2s; text-align: center; padding: 5px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); position: relative; }
        .cat-btn:hover { transform: translateY(-3px); }
        .cat-btn i { font-size: 28px; margin-bottom: 5px; }
        .cat-btn.active { box-shadow: 0 0 0 4px #fff, 0 0 0 6px #2196F3; z-index: 2; transform: scale(1.05); }
        .bg-blue { background-color: #42A5F5; } .bg-green { background-color: #AED581; } .bg-orange { background-color: #FFB74D; } .bg-brown { background-color: #D7CCC8; color: #5D4037; } .bg-purple { background-color: #BA68C8; } .bg-yellow { background-color: #FFF176; color: #333; } .bg-grey { background-color: #90A4AE; } .bg-peach { background-color: #FF8A65; } .bg-red { background-color: #EF5350; }
        .grid-products { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 20px; }
        .card { background: white; border-radius: 15px; padding: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between; position: relative; transition: 0.2s; }
        .card:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.15); }
        .card-img { width: 100%; height: 140px; object-fit: contain; margin-bottom: 10px; }
        .card-title { font-size: 16px; font-weight: bold; color: #333; margin-bottom: 5px; height: 40px; overflow: hidden; }
        .card-price { font-size: 14px; color: var(--price-green); font-weight: bold; margin-bottom: 8px; }
        .card-meta { font-size: 11px; color: #888; display: flex; align-items: center; gap: 5px; margin-bottom: 5px; }
        .star { color: #FFC107; }
        .delivery-info { font-size: 10px; color: #558B2F; display: flex; align-items: center; gap: 3px; }
        .card-actions { position: absolute; bottom: 15px; right: 15px; display: flex; align-items: center; gap: 8px; }
        .btn-buy { background-color: var(--primary-green); color: white; border: none; padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; cursor: pointer; transition: 0.2s; text-decoration: none; }
        .btn-buy:hover { background-color: #3e6b1e; }
        .btn-add { width: 32px; height: 32px; border-radius: 50%; border: 1px solid #333; background: white; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; color: #333; }
        .btn-add:hover { background: #eee; }
        .fly-item { position: fixed; z-index: 9999; width: 30px; height: 30px; background: #558B2F; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; pointer-events: none; transition: all 0.8s cubic-bezier(0.19, 1, 0.22, 1); }
        @media (max-width: 768px) { .grid-products { grid-template-columns: repeat(2, 1fr); } .navbar { flex-wrap: wrap; } .search-container { order: 3; width: 100%; margin: 10px 0 0 0; } }
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
        <a href="kategori.html"><i class="fas fa-list"></i> Kategori</a>
        <a href="keranjang.html"><i class="fas fa-tags"></i> Keranjang</a>
        <a href="pesanan anda.html"><i class="fas fa-heart"></i> pesanan anda/a>
        <a href="Riwayat.html"><i class="fas fa-cog"></i> riwayat</a>
        <a href="ubahprofile.html"><i class="fas fa-cog"></i> ubah profile </a>
        <a href="Faq.html"><i class="fas fa-cog"></i> Faq </a>
        <a href="contact.html"><i class="fas fa-cog"></i> contact us </a>
        <a href="login.html" style="color: red;"><i class="fas fa-sign-out-alt"></i> Keluar</a>
    </nav>

    <header class="navbar">
        <div class="nav-left" id="openSidebar"><i class="fas fa-bars"></i></div>
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search.....">
            <button class="search-btn"><i class="fas fa-search"></i></button>
        </div>
        <div class="nav-right">
            <a href="keranjang.html" class="cart-icon-container">
                <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                <span class="cart-badge" id="cartBadge">0</span>
            </a>
            <div class="user-profile"><i class="fas fa-user-circle" style="font-size: 24px;"></i> <span>nama akun</span></div>
        </div>
    </header>

    <div class="container">
        <h2 class="page-title">KATEGORI</h2>
        
        <div class="category-filter-scroll">
            <div class="cat-btn bg-blue" data-filter="all"><i class="fas fa-th-large"></i> Semua</div>
            <div class="cat-btn bg-blue" data-filter="makanan-kaleng"><i class="fas fa-fish"></i> Makanan Kaleng</div>
            <div class="cat-btn bg-green" data-filter="sayuran"><i class="fas fa-carrot"></i> Sayuran</div>
            <div class="cat-btn bg-orange" data-filter="cemilan"><i class="fas fa-cookie-bite"></i> Cemilan</div>
            <div class="cat-btn bg-brown" data-filter="coklat"><i class="fas fa-chocolate"></i> Coklat</div>
            <div class="cat-btn bg-blue" data-filter="permen"><i class="fas fa-candy-cane"></i> Permen</div>
            <div class="cat-btn bg-brown" data-filter="roti"><i class="fas fa-bread-slice"></i> Roti</div>
            <div class="cat-btn bg-yellow" data-filter="mie"><i class="fas fa-utensils"></i> Mie</div>
            <div class="cat-btn bg-grey" data-filter="frozen"><i class="fas fa-snowflake"></i> Frozen Food</div>
            <div class="cat-btn bg-peach" data-filter="buah"><i class="fas fa-apple-alt"></i> Buah-Buahan</div>
             <div class="cat-btn bg-red" data-filter="daging"><i class="fas fa-drumstick-bite"></i> Daging</div>
        </div>

        <div class="grid-products">
            <div class="card" data-category="makanan-kaleng">
                <img src="https://via.placeholder.com/150x150?text=Sarden+ABC" class="card-img" alt="Product">
                <h3 class="card-title">Sarden 155 g</h3>
                <div class="card-price">RP 14.000</div>
                <div class="card-meta"><span>5rb+ Terjual</span> | <i class="fas fa-star star"></i> 4.5</div>
                <div class="delivery-info"><i class="fas fa-truck"></i> 1-2 hari | KAB. BEKASI</div>
                <div class="card-actions">
                    <button class="btn-buy" onclick="buyNow(this)" data-id="c1" data-name="Sarden ABC 155g" data-price="14000" data-img="https://via.placeholder.com/150x150?text=Sarden+ABC">Beli</button>
                    <div class="btn-add add-to-cart-btn" data-id="c1" data-name="Sarden ABC 155g" data-price="14000" data-img="https://via.placeholder.com/150x150?text=Sarden+ABC"><i class="fas fa-plus"></i></div>
                </div>
            </div>
            <div class="card" data-category="sayuran">
                <img src="https://via.placeholder.com/150x150?text=Bayam" class="card-img" alt="Product">
                <h3 class="card-title">Bayam Segar</h3>
                <div class="card-price">RP 5.000</div>
                <div class="card-meta"><span>100+ Terjual</span> | <i class="fas fa-star star"></i> 5.0</div>
                <div class="delivery-info"><i class="fas fa-truck"></i> Instan | KAB. BEKASI</div>
                <div class="card-actions">
                    <button class="btn-buy" onclick="buyNow(this)" data-id="c7" data-name="Bayam Segar" data-price="5000" data-img="https://via.placeholder.com/150x150?text=Bayam">Beli</button>
                    <div class="btn-add add-to-cart-btn" data-id="c7" data-name="Bayam Segar" data-price="5000" data-img="https://via.placeholder.com/150x150?text=Bayam"><i class="fas fa-plus"></i></div>
                </div>
            </div>
            <div class="card" data-category="cemilan">
                <img src="https://via.placeholder.com/150x150?text=Chitato" class="card-img" alt="Product">
                <h3 class="card-title">Chitato Sapi Panggang</h3>
                <div class="card-price">RP 10.000</div>
                <div class="card-meta"><span>500+ Terjual</span> | <i class="fas fa-star star"></i> 4.8</div>
                <div class="delivery-info"><i class="fas fa-truck"></i> 1-2 hari | KAB. BEKASI</div>
                <div class="card-actions">
                    <button class="btn-buy" onclick="buyNow(this)" data-id="c8" data-name="Chitato" data-price="10000" data-img="https://via.placeholder.com/150x150?text=Chitato">Beli</button>
                    <div class="btn-add add-to-cart-btn" data-id="c8" data-name="Chitato" data-price="10000" data-img="https://via.placeholder.com/150x150?text=Chitato"><i class="fas fa-plus"></i></div>
                </div>
            </div>
            <div class="card" data-category="buah">
                <img src="https://via.placeholder.com/150x150?text=Apel" class="card-img" alt="Product">
                <h3 class="card-title">Apel Fuji (1kg)</h3>
                <div class="card-price">RP 35.000</div>
                <div class="card-meta"><span>200+ Terjual</span> | <i class="fas fa-star star"></i> 4.9</div>
                <div class="delivery-info"><i class="fas fa-truck"></i> 1-2 hari | KAB. BEKASI</div>
                <div class="card-actions">
                    <button class="btn-buy" onclick="buyNow(this)" data-id="c9" data-name="Apel Fuji" data-price="35000" data-img="https://via.placeholder.com/150x150?text=Apel">Beli</button>
                    <div class="btn-add add-to-cart-btn" data-id="c9" data-name="Apel Fuji" data-price="35000" data-img="https://via.placeholder.com/150x150?text=Apel"><i class="fas fa-plus"></i></div>
                </div>
            </div>
            <div class="card" data-category="daging">
                <img src="https://via.placeholder.com/150x150?text=Daging+Sapi" class="card-img" alt="Product">
                <h3 class="card-title">Daging Sapi Segar (500g)</h3>
                <div class="card-price">RP 65.000</div>
                <div class="card-meta"><span>300+ Terjual</span> | <i class="fas fa-star star"></i> 4.8</div>
                <div class="delivery-info"><i class="fas fa-truck"></i> Instan | KAB. BEKASI</div>
                <div class="card-actions">
                    <button class="btn-buy" onclick="buyNow(this)" data-id="c10" data-name="Daging Sapi" data-price="65000" data-img="https://via.placeholder.com/150x150?text=Daging+Sapi">Beli</button>
                    <div class="btn-add add-to-cart-btn" data-id="c10" data-name="Daging Sapi" data-price="65000" data-img="https://via.placeholder.com/150x150?text=Daging+Sapi"><i class="fas fa-plus"></i></div>
                </div>
            </div>
            <div class="card" data-category="frozen">
                <img src="https://via.placeholder.com/150x150?text=Nugget" class="card-img" alt="Product">
                <h3 class="card-title">Fiesta Chicken Nugget</h3>
                <div class="card-price">RP 45.000</div>
                <div class="card-meta"><span>1rb+ Terjual</span> | <i class="fas fa-star star"></i> 4.7</div>
                <div class="delivery-info"><i class="fas fa-truck"></i> 1-2 hari | KAB. BEKASI</div>
                <div class="card-actions">
                    <button class="btn-buy" onclick="buyNow(this)" data-id="c11" data-name="Chicken Nugget" data-price="45000" data-img="https://via.placeholder.com/150x150?text=Nugget">Beli</button>
                    <div class="btn-add add-to-cart-btn" data-id="c11" data-name="Chicken Nugget" data-price="45000" data-img="https://via.placeholder.com/150x150?text=Nugget"><i class="fas fa-plus"></i></div>
                </div>
            </div>
            <div class="card" data-category="makanan-kaleng">
                <img src="https://via.placeholder.com/150x150?text=Pronas+Corned" class="card-img" alt="Product">
                <h3 class="card-title">Pronas Corned Beef</h3>
                <div class="card-price">RP 45.000</div>
                <div class="card-meta"><span>1rb+ Terjual</span> | <i class="fas fa-star star"></i> 4.8</div>
                <div class="card-actions">
                    <button class="btn-buy" onclick="buyNow(this)" data-id="c2" data-name="Pronas Corned Beef" data-price="45000" data-img="https://via.placeholder.com/150x150?text=Pronas+Corned">Beli</button>
                    <div class="btn-add add-to-cart-btn" data-id="c2" data-name="Pronas Corned Beef" data-price="45000" data-img="https://via.placeholder.com/150x150?text=Pronas+Corned"><i class="fas fa-plus"></i></div>
                </div>
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

        const catButtons = document.querySelectorAll('.cat-btn');
        const products = document.querySelectorAll('.card');

        function applyFilter(filter) {
            catButtons.forEach(b => {
                if(b.getAttribute('data-filter') === filter) { b.classList.add('active'); b.classList.remove('bg-grey'); } 
                else { b.classList.remove('active'); }
            });
            products.forEach(product => {
                if (filter === 'all' || product.getAttribute('data-category') === filter) { product.style.display = 'flex'; } 
                else { product.style.display = 'none'; }
            });
        }

        catButtons.forEach(btn => btn.addEventListener('click', () => applyFilter(btn.getAttribute('data-filter'))));

        window.addEventListener('load', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const filterParam = urlParams.get('filter');
            if (filterParam) applyFilter(filterParam); else applyFilter('all');
            updateCartBadge();
        });

        function updateCartBadge() {
            const cart = JSON.parse(localStorage.getItem('snapShopCart')) || [];
            const badge = document.getElementById('cartBadge');
            const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
            badge.innerText = totalItems;
            if (totalItems > 0) badge.classList.add('show'); else badge.classList.remove('show');
        }

        function addToCartClick(event) {
            const btn = event.currentTarget;
            const product = {
                id: btn.getAttribute('data-id'), name: btn.getAttribute('data-name'),
                price: parseInt(btn.getAttribute('data-price')), img: btn.getAttribute('data-img'), qty: 1
            };
            const flyer = document.createElement('div');
            flyer.classList.add('fly-item'); flyer.innerHTML = '<i class="fas fa-plus"></i>';
            document.body.appendChild(flyer);
            const startPos = btn.getBoundingClientRect();
            const endPos = document.querySelector('.fa-shopping-cart').getBoundingClientRect();
            flyer.style.left = startPos.left + 'px'; flyer.style.top = startPos.top + 'px';
            setTimeout(() => { flyer.style.left = (endPos.left + 10) + 'px'; flyer.style.top = (endPos.top + 10) + 'px'; flyer.style.opacity = '0'; flyer.style.transform = 'scale(0.5)'; }, 50);
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

        // --- UPDATE PENTING: LOGIKA BELI SEKARANG ---
        function buyNow(btn) {
            const product = {
                id: btn.getAttribute('data-id'),
                name: btn.getAttribute('data-name'),
                price: parseInt(btn.getAttribute('data-price')),
                img: btn.getAttribute('data-img'),
                qty: 1
            };

            // Simpan barang khusus ini untuk halaman checkout (beda storage dengan cart)
            localStorage.setItem('snapShopDirectCheckout', JSON.stringify(product));
            
            // Langsung pindah ke halaman checkout
            window.location.href = 'checkout barang.html';
        }
    </script>
</body>
</html>
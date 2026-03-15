<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap Shop - Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --header-green: #9CCC65; 
            --primary-green: #558B2F;
            --bg-color: #f4f4f4;
            --text-dark: #333;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); padding-bottom: 90px; }

        /* --- HEADER --- */
        .navbar {
            background-color: var(--header-green);
            padding: 15px 20px;
            display: flex; align-items: center;
            position: sticky; top: 0; z-index: 1000;
            color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .nav-left { color: white; font-size: 20px; text-decoration: none; margin-right: 20px; }
        .page-title { font-size: 18px; font-weight: bold; }

        .container { max-width: 800px; margin: 20px auto; padding: 0 15px; }

        /* --- KARTU SECTION (Putih) --- */
        .section-card {
            background: var(--white);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .section-title {
            font-size: 16px; font-weight: bold; color: var(--primary-green);
            margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;
            display: flex; align-items: center; gap: 10px;
        }

        /* --- FORM ALAMAT --- */
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 13px; color: #666; margin-bottom: 5px; }
        .form-input {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;
            outline: none; transition: 0.3s;
        }
        .form-input:focus { border-color: var(--primary-green); }
        textarea.form-input { resize: vertical; min-height: 80px; }

        /* --- KARTU PRODUK (SESUAI GAMBAR DANCOW) --- */
        .product-card {
            display: flex; gap: 15px;
            border: 1px solid #eee; border-radius: 10px; padding: 15px;
        }
        .p-img-box {
            width: 100px; height: 100px; flex-shrink: 0;
            background: #f9f9f9; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .p-img-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        
        .p-details { flex-grow: 1; display: flex; flex-direction: column; justify-content: center; }
        .p-title { font-size: 16px; font-weight: bold; color: #333; margin-bottom: 5px; text-transform: uppercase;}
        .p-price { font-size: 18px; color: var(--primary-green); font-weight: bold; margin-bottom: 5px; }
        
        .p-rating { font-size: 14px; color: #FFC107; display: flex; align-items: center; gap: 5px; font-weight: bold; }
        .p-sold { font-size: 12px; color: #888; margin-top: 5px; }

        /* --- RINGKASAN PEMBAYARAN --- */
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; color: #555; }
        .summary-total { display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ddd; font-size: 18px; font-weight: bold; color: var(--text-dark); }

        /* --- BOTTOM BAR --- */
        .bottom-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: white; padding: 15px 20px;
            box-shadow: 0 -4px 10px rgba(0,0,0,0.1);
            display: flex; justify-content: space-between; align-items: center;
        }
        .total-label { font-size: 12px; color: #666; }
        .final-price { font-size: 20px; font-weight: bold; color: var(--primary-green); }
        
        .btn-checkout {
            background-color: var(--primary-green); color: white;
            border: none; padding: 12px 30px; border-radius: 8px;
            font-size: 16px; font-weight: bold; cursor: pointer;
            transition: 0.3s;
        }
        .btn-checkout:hover { background-color: #3e6b1e; }

        @media (max-width: 600px) {
            .product-card { flex-direction: row; }
            .p-img-box { width: 80px; height: 80px; }
            .p-title { font-size: 14px; }
        }
    </style>
</head>
<body>

    <header class="navbar">
        <a href="Kategori.html" class="nav-left">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="page-title">Checkout / Pengiriman</div>
    </header>

    <div class="container">
        
        <div class="section-card">
            <div class="section-title">
                <i class="fas fa-map-marker-alt"></i> Alamat Pengiriman
            </div>
            <form>
                <div class="form-group">
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" class="form-input" placeholder="Contoh: Budi Santoso" value="Nama Akun Anda">
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-input" placeholder="08123xxxxxx">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-input" placeholder="Jalan, Nomor Rumah, RT/RW, Kecamatan..."></textarea>
                </div>
            </form>
        </div>

        <div class="section-card">
            <div class="section-title">
                <i class="fas fa-box"></i> Rincian Produk
            </div>
            
            <div class="product-card">
                <div class="p-img-box">
                    <img src="https://via.placeholder.com/150x150/fdfbe0/333?text=DANCOW" alt="Dancow">
                </div>
                <div class="p-details">
                    <div class="p-title">SUSU DANCOW COKLAT 800 GRAM ORIGINAL</div>
                    <div class="p-price">RP 131.000,00</div>
                    <div class="p-rating">
                        <i class="fas fa-star"></i> 4.5
                    </div>
                    <div class="p-sold">Laku Terjual 5 Rb+ Per pack</div>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <i class="fas fa-credit-card"></i> Metode Pembayaran
            </div>
            <select class="form-input" style="background: white;">
                <option>Virtual Account</option>
                <option>COD (Bayar di Tempat)</option>
                <option>QRIS</option>
            </select>
        </div>

        <div class="section-card" style="margin-bottom: 100px;">
            <div class="summary-row">
                <span>Subtotal Produk</span>
                <span>RP 131.000</span>
            </div>
            <div class="summary-row">
                <span>Biaya Pengiriman</span>
                <span>RP 15.000</span>
            </div>
            <div class="summary-row">
                <span>Biaya Layanan</span>
                <span>RP 1.000</span>
            </div>
            <div class="summary-total">
                <span>Total Pembayaran</span>
                <span style="color: var(--primary-green);">RP 147.000</span>
            </div>
        </div>

    </div>

    <div class="bottom-bar">
        <div>
            <div class="total-label">Total Tagihan</div>
            <div class="final-price">RP 147.000</div>
        </div>
        <button class="btn-checkout" onclick="prosesPesanan()">Buat Pesanan</button>
    </div>

<script>
        function formatRupiah(angka) { 
            return 'RP ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
        }

        document.addEventListener('DOMContentLoaded', () => {
            const productListContainer = document.getElementById('checkoutProductList');
            let checkoutItems = JSON.parse(localStorage.getItem('snapShopCheckoutPayload'));

            // ... (Kode bagian menampilkan produk sama seperti sebelumnya, tidak perlu diubah) ...
            // Pastikan kode untuk menampilkan produk dari LocalStorage tetap ada di sini
            
            if (checkoutItems) {
                 const items = checkoutItems.items;
                 // ... Loop items & update harga ...
            }
        });

        // --- UPDATE PENTING: LOGIKA TOMBOL BUAT PESANAN ---
        function prosesPesanan() {
            const alamat = document.querySelector('textarea').value;
            const metodePembayaran = document.querySelector('select.form-input').value; // Ambil nilai dropdown

            if(alamat.trim() === "") {
                alert("Mohon isi alamat pengiriman terlebih dahulu!");
                return;
            }

            const btn = document.querySelector('.btn-checkout');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            btn.style.opacity = "0.7";
            
            setTimeout(() => {
                // Cek Metode Pembayaran dan Arahkan
                if (metodePembayaran === "QRIS") {
                    window.location.href = 'Qris.html';
                } else if (metodePembayaran === "Virtual Account") {
                    window.location.href = 'transfer bank.html';
                } else {
                    alert("Metode pembayaran ini belum tersedia. Silakan pilih QRIS atau VA.");
                    btn.innerHTML = 'Buat Pesanan';
                    btn.style.opacity = "1";
                }
            }, 1000);
        }
    </script>

</body>
</html>
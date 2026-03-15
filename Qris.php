<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS - Snap Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-green: #558B2F; --bg-color: #f4f4f4; --white: #ffffff; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); display: flex; justify-content: center; padding: 20px; min-height: 100vh; }

        .payment-container { 
            background: white; width: 100%; max-width: 400px; padding: 30px; 
            border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center; height: fit-content;
        }
        
        .header { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px; }
        .logo { font-size: 24px; font-weight: bold; color: var(--primary-green); display: flex; align-items: center; justify-content: center; gap: 10px; }
        
        .timer-box { background: #fff3cd; color: #856404; padding: 10px; border-radius: 8px; font-size: 14px; margin-bottom: 20px; font-weight: bold;}
        
        .qr-box { margin: 20px 0; position: relative; display: inline-block; padding: 10px; border: 2px dashed #ddd; border-radius: 10px; }
        .qr-img { width: 200px; height: 200px; object-fit: contain; }
        
        .amount-box { background: #f8f9fa; padding: 15px; border-radius: 10px; margin-top: 20px; }
        .label { font-size: 12px; color: #666; }
        .amount { font-size: 24px; font-weight: bold; color: #333; margin-top: 5px; }
        
        .btn-done { background: var(--primary-green); color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; font-size: 16px; font-weight: bold; margin-top: 25px; cursor: pointer; transition: 0.3s; }
        .btn-done:hover { background: #3e6b1e; }
        
        .steps { text-align: left; margin-top: 20px; font-size: 13px; color: #555; background: #fafafa; padding: 15px; border-radius: 8px; }
        .steps li { margin-bottom: 8px; }

        /* --- CUSTOM ALERT STYLES (SAMA DENGAN VA) --- */
        .custom-alert-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); z-index: 2000;
            display: none; justify-content: center; align-items: center;
            opacity: 0; transition: opacity 0.3s;
        }
        .custom-alert-box {
            background: white; width: 90%; max-width: 350px;
            padding: 30px; border-radius: 20px; text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transform: scale(0.7); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .custom-alert-overlay.show { display: flex; opacity: 1; }
        .custom-alert-overlay.show .custom-alert-box { transform: scale(1); }

        .success-icon-container {
            width: 80px; height: 80px; background: #e8f5e9;
            border-radius: 50%; display: flex; justify-content: center; align-items: center;
            margin: 0 auto 20px auto;
        }
        .success-icon { font-size: 40px; color: var(--primary-green); animation: bounceIn 0.8s; }
        
        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); }
        }

        .alert-title { font-size: 22px; font-weight: bold; margin-bottom: 10px; color: #333; }
        .alert-desc { font-size: 14px; color: #666; margin-bottom: 25px; line-height: 1.5; }
        
        .btn-home {
            background: var(--primary-green); color: white; border: none;
            padding: 12px 30px; border-radius: 25px; font-size: 16px; font-weight: bold;
            cursor: pointer; width: 100%; box-shadow: 0 4px 10px rgba(85, 139, 47, 0.3);
            transition: transform 0.2s;
        }
        .btn-home:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(85, 139, 47, 0.4); }
    </style>
</head>
<body>

    <div class="payment-container">
        <div class="header">
            <div class="logo"><i class="fas fa-shopping-bag"></i> Snap Shop</div>
            <p style="margin-top: 5px; color: #666;">Pembayaran QRIS</p>
        </div>

        <div class="timer-box">
            Selesaikan dalam <span id="timer">15:00</span>
        </div>

        <p style="font-size: 14px;">Scan QR di bawah ini dengan aplikasi e-wallet Anda (Gopay, OVO, Dana, ShopeePay, BCA Mobile, dll)</p>

        <div class="qr-box">
            <img src="https://via.placeholder.com/200x200?text=SCAN+ME" class="qr-img" alt="QRIS">
        </div>

        <div class="amount-box">
            <div class="label">Total Pembayaran</div>
            <div class="amount" id="displayAmount">RP 0</div>
        </div>

        <div class="steps">
            <strong>Cara Pembayaran:</strong>
            <ol style="padding-left: 20px; margin-top: 10px;">
                <li>Buka aplikasi e-wallet atau m-banking.</li>
                <li>Pilih menu <strong>Scan / Bayar</strong>.</li>
                <li>Arahkan kamera ke kode QR di atas.</li>
                <li>Periksa nama merchant <strong>Snap Shop</strong>.</li>
                <li>Masukkan PIN dan pembayaran selesai.</li>
            </ol>
        </div>

        <button class="btn-done" onclick="selesaiBayar()">Saya Sudah Bayar</button>
    </div>

    <div class="custom-alert-overlay" id="successAlert">
        <div class="custom-alert-box">
            <div class="success-icon-container">
                <i class="fas fa-check success-icon"></i>
            </div>
            <div class="alert-title">Pembayaran Berhasil!</div>
            <div class="alert-desc">
                Terima kasih, pembayaran QRIS Anda telah terverifikasi. Pesanan sedang diproses.
            </div>
            <button class="btn-home" onclick="goToHome()">Kembali ke Beranda</button>
        </div>
    </div>

    <script>
        // 1. Format Rupiah
        function formatRupiah(angka) { 
            return 'RP ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
        }

        // 2. Load Harga Dinamis
        document.addEventListener('DOMContentLoaded', () => {
            const payload = JSON.parse(localStorage.getItem('snapShopCheckoutPayload'));
            
            if (payload && payload.items) {
                let subtotal = 0;
                payload.items.forEach(item => { subtotal += item.price * item.qty; });
                const total = subtotal + 15000 + 1000; // +Ongkir & Admin
                document.getElementById('displayAmount').innerText = formatRupiah(total);
            }
        });

        // 3. Timer Hitung Mundur
        let time = 15 * 60; // 15 menit
        const timerElement = document.getElementById('timer');

        setInterval(() => {
            const minutes = Math.floor(time / 60);
            let seconds = time % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            timerElement.innerHTML = `${minutes}:${seconds}`;
            if (time > 0) time--;
        }, 1000);

        // 4. Logika Tombol Saya Sudah Bayar
        function selesaiBayar() {
            const btn = document.querySelector('.btn-done');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengecek...';
            btn.style.opacity = "0.8";

            setTimeout(() => {
                // Tampilkan Custom Alert
                const alertBox = document.getElementById('successAlert');
                alertBox.classList.add('show');
            }, 1500);
        }

        // 5. Logika Tombol Kembali ke Beranda
        function goToHome() {
            const payload = JSON.parse(localStorage.getItem('snapShopCheckoutPayload'));
            
            // Hapus keranjang HANYA JIKA checkout berasal dari keranjang
            if (payload && payload.source === 'cart') {
                localStorage.removeItem('snapShopCart');
            }
            
            // Hapus data transaksi sementara
            localStorage.removeItem('snapShopCheckoutPayload');
            
            window.location.href = 'beranda.html';
        }
    </script>
</body>
</html>
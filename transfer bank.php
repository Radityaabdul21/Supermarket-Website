<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran VA - Snap Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-green: #558B2F; --bg-color: #f4f4f4; --white: #ffffff; --border-color: #ddd; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); display: flex; justify-content: center; padding: 20px; color: #333; position: relative; min-height: 100vh; }

        .container { background: var(--white); width: 100%; max-width: 450px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow: hidden; height: fit-content; }
        .header { padding: 20px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 18px; font-weight: bold; color: var(--primary-green); display: flex; align-items: center; gap: 5px; }
        .timer { font-size: 14px; font-weight: bold; color: #ff6b6b; background: #fff0f0; padding: 5px 10px; border-radius: 15px; }
        .content { padding: 20px; }
        .total-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .label { font-size: 13px; color: #666; }
        .amount { font-size: 20px; font-weight: bold; color: var(--primary-green); }
        .bank-header { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; border-bottom: 1px dashed var(--border-color); padding-bottom: 15px; }
        .bank-logo { width: 60px; height: 30px; object-fit: contain; }
        .bank-name { font-weight: bold; font-size: 16px; }
        .va-box { background: #f8f9fa; border: 1px solid var(--border-color); border-radius: 8px; padding: 15px; position: relative; margin-bottom: 25px; }
        .va-label { font-size: 12px; color: #666; margin-bottom: 5px; }
        .va-number { font-size: 22px; font-weight: bold; letter-spacing: 1px; color: #333; }
        .copy-btn { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: var(--primary-green); font-weight: bold; font-size: 13px; cursor: pointer; background: none; border: none; }
        .instructions-title { font-weight: bold; font-size: 15px; margin-bottom: 10px; }
        .accordion-item { border: 1px solid var(--border-color); border-radius: 8px; margin-bottom: 10px; overflow: hidden; }
        .accordion-header { background: #fff; padding: 12px 15px; cursor: pointer; font-size: 14px; font-weight: 600; display: flex; justify-content: space-between; align-items: center; }
        .accordion-content { display: none; padding: 15px; background: #fcfcfc; border-top: 1px solid var(--border-color); font-size: 13px; color: #555; line-height: 1.6; }
        .accordion-content ol { padding-left: 20px; }
        .accordion-item.active .accordion-content { display: block; }
        .accordion-item.active .accordion-header i { transform: rotate(180deg); }
        .btn-check { display: block; width: 100%; padding: 15px; background: var(--primary-green); color: white; border: none; font-weight: bold; font-size: 16px; cursor: pointer; text-align: center; transition: 0.3s; }
        .btn-check:hover { background: #3e6b1e; }

        /* --- CUSTOM ALERT STYLES --- */
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

        /* Animasi Centang */
        .success-icon-container {
            width: 80px; height: 80px; background: #e8f5e9;
            border-radius: 50%; display: flex; justify-content: center; align-items: center;
            margin: 0 auto 20px auto;
        }
        .success-icon {
            font-size: 40px; color: var(--primary-green);
            animation: bounceIn 0.8s;
        }
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

    <div class="container">
        <div class="header">
            <div class="logo"><i class="fas fa-shopping-bag"></i> Snap Shop</div>
            <div class="timer" id="timer">23:59:59</div>
        </div>

        <div class="content">
            <div class="total-section">
                <div><div class="label">Total Pembayaran</div><div class="amount" id="displayAmount">RP 0</div></div>
            </div>

            <div class="bank-header">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" class="bank-logo" alt="BCA">
                <div class="bank-name">BCA Virtual Account</div>
            </div>

            <div class="va-box">
                <div class="va-label">Nomor Virtual Account</div>
                <div class="va-number" id="vaCode">8801234567890</div>
                <button class="copy-btn" onclick="copyVA()">SALIN</button>
            </div>

            <div class="instructions-title">Cara Pembayaran</div>
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">ATM BCA <i class="fas fa-chevron-down"></i></div>
                <div class="accordion-content">
                    <ol><li>Masukkan Kartu & PIN.</li><li>Menu Transaksi Lainnya > Transfer > ke BCA Virtual Account.</li><li>Masukkan No VA: <b class="va-text"></b>.</li><li>Konfirmasi & Selesai.</li></ol>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion(this)">m-BCA <i class="fas fa-chevron-down"></i></div>
                <div class="accordion-content">
                    <ol><li>Buka m-BCA > m-Transfer > BCA Virtual Account.</li><li>Masukkan No VA: <b class="va-text"></b>.</li><li>Klik Send & Masukkan PIN.</li></ol>
                </div>
            </div>
        </div>
        <button class="btn-check" onclick="cekStatus()">Cek Status Pembayaran</button>
    </div>

    <div class="custom-alert-overlay" id="successAlert">
        <div class="custom-alert-box">
            <div class="success-icon-container">
                <i class="fas fa-check success-icon"></i>
            </div>
            <div class="alert-title">Pembayaran Berhasil!</div>
            <div class="alert-desc">
                Terima kasih, transaksi Anda telah berhasil dikonfirmasi. Pesanan akan segera diproses.
            </div>
            <button class="btn-home" onclick="goToHome()">Kembali ke Beranda</button>
        </div>
    </div>

    <script>
        function formatRupiah(angka) { return 'RP ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }

        document.addEventListener('DOMContentLoaded', () => {
            const payload = JSON.parse(localStorage.getItem('snapShopCheckoutPayload'));
            const randomVA = "880" + Math.floor(1000000000 + Math.random() * 9000000000);
            document.getElementById('vaCode').innerText = randomVA;
            document.querySelectorAll('.va-text').forEach(el => el.innerText = randomVA);

            if (payload && payload.items) {
                let subtotal = 0;
                payload.items.forEach(item => { subtotal += item.price * item.qty; });
                const total = subtotal + 15000 + 1000; 
                document.getElementById('displayAmount').innerText = formatRupiah(total);
            }
        });

        function copyVA() {
            navigator.clipboard.writeText(document.getElementById('vaCode').innerText).then(() => {
                const btn = document.querySelector('.copy-btn');
                btn.innerText = "TERSALIN!"; setTimeout(() => btn.innerText = "SALIN", 2000);
            });
        }

        function toggleAccordion(header) {
            const item = header.parentElement;
            document.querySelectorAll('.accordion-item').forEach(el => { if(el !== item) el.classList.remove('active'); });
            item.classList.toggle('active');
        }

        let timeInSeconds = 24 * 60 * 60;
        setInterval(() => {
            timeInSeconds--;
            const h = Math.floor(timeInSeconds/3600), m = Math.floor((timeInSeconds%3600)/60), s = timeInSeconds%60;
            document.getElementById('timer').innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
        }, 1000);

        // --- LOGIKA ALERT BARU ---
        function cekStatus() {
            const btn = document.querySelector('.btn-check');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengecek...';
            btn.style.opacity = '0.8';

            setTimeout(() => {
                // Munculkan Custom Alert
                const alertBox = document.getElementById('successAlert');
                alertBox.classList.add('show');
            }, 1500);
        }

        function goToHome() {
            // Bersihkan data sebelum pindah
            const payload = JSON.parse(localStorage.getItem('snapShopCheckoutPayload'));
            if(payload && payload.source === 'cart') { localStorage.removeItem('snapShopCart'); }
            localStorage.removeItem('snapShopCheckoutPayload');
            
            window.location.href = 'beranda.html';
        }
    </script>
</body>
</html>
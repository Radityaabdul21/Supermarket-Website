<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - Snap Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-green: #558B2F; --bg-color: #f4f4f4; --white: #ffffff; --star-color: #FFC107; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background-color: var(--bg-color); padding-bottom: 50px; }

        /* HEADER */
        .navbar { background-color: #9CCC65; padding: 15px 20px; display: flex; align-items: center; position: sticky; top: 0; z-index: 1000; color: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .nav-left { font-size: 20px; cursor: pointer; margin-right: 15px; color: white; text-decoration: none; }
        .page-title { font-size: 18px; font-weight: bold; }

        .container { max-width: 600px; margin: 20px auto; padding: 0 15px; }

        /* PRODUCT INFO */
        .product-info {
            background: white; padding: 15px; border-radius: 10px; display: flex; gap: 15px;
            align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px;
        }
        .p-img { width: 60px; height: 60px; object-fit: contain; border: 1px solid #eee; border-radius: 5px; }
        .p-name { font-weight: bold; font-size: 14px; color: #333; }

        /* RATING SECTION */
        .rating-card {
            background: white; padding: 25px; border-radius: 10px; text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px;
        }
        .rating-title { font-weight: bold; margin-bottom: 15px; color: #333; }
        
        .stars { font-size: 35px; color: #ddd; cursor: pointer; display: flex; justify-content: center; gap: 10px; margin-bottom: 20px; }
        .stars i.active { color: var(--star-color); animation: pop 0.3s ease; }
        
        @keyframes pop { 50% { transform: scale(1.3); } }

        /* INPUTS */
        .review-text {
            width: 100%; border: 1px solid #ddd; border-radius: 8px; padding: 12px;
            font-family: inherit; font-size: 14px; resize: none; height: 100px; outline: none;
            background: #fafafa;
        }
        .review-text:focus { border-color: var(--primary-green); background: white; }

        /* UPLOAD PHOTO */
        .upload-box {
            margin-top: 15px; border: 2px dashed #ddd; border-radius: 8px; padding: 20px;
            color: #888; font-size: 13px; cursor: pointer; transition: 0.2s;
            display: flex; flex-direction: column; align-items: center; gap: 5px;
        }
        .upload-box:hover { border-color: var(--primary-green); color: var(--primary-green); background: #f0f8ef; }
        .camera-icon { font-size: 24px; }

        /* SUBMIT BUTTON */
        .btn-submit {
            background: var(--primary-green); color: white; width: 100%; border: none;
            padding: 15px; border-radius: 30px; font-size: 16px; font-weight: bold;
            cursor: pointer; box-shadow: 0 4px 10px rgba(85, 139, 47, 0.3); transition: 0.3s;
        }
        .btn-submit:hover { background: #3e6b1e; transform: translateY(-2px); }

        /* --- CUSTOM ALERT (Sama dengan Payment) --- */
        .custom-alert-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6); z-index: 2000; display: none;
            justify-content: center; align-items: center; opacity: 0; transition: opacity 0.3s;
        }
        .custom-alert-box {
            background: white; width: 90%; max-width: 350px; padding: 30px;
            border-radius: 20px; text-align: center; transform: scale(0.7);
            transition: transform 0.3s;
        }
        .custom-alert-overlay.show { display: flex; opacity: 1; }
        .custom-alert-overlay.show .custom-alert-box { transform: scale(1); }
        .success-icon { font-size: 50px; color: var(--primary-green); margin-bottom: 15px; animation: bounceIn 0.8s; }
        @keyframes bounceIn { 0% { transform: scale(0); } 50% { transform: scale(1.2); } 100% { transform: scale(1); } }
        .btn-alert {
            background: var(--primary-green); color: white; padding: 10px 25px; border-radius: 20px;
            border: none; font-weight: bold; cursor: pointer; margin-top: 20px; width: 100%;
        }

    </style>
</head>
<body>

    <header class="navbar">
        <a href="riwayat.html" class="nav-left"><i class="fas fa-arrow-left"></i></a>
        <div class="page-title">Tulis Ulasan</div>
    </header>

    <div class="container">
        
        <div class="product-info">
            <img src="https://via.placeholder.com/150x150/fdfbe0/333?text=Dancow" class="p-img">
            <div class="p-name">Dancow Coklat 780 g</div>
        </div>

        <div class="rating-card">
            <div class="rating-title">Bagaimana kualitas produk ini?</div>
            
            <div class="stars" id="starContainer">
                <i class="fas fa-star" onclick="rate(1)"></i>
                <i class="fas fa-star" onclick="rate(2)"></i>
                <i class="fas fa-star" onclick="rate(3)"></i>
                <i class="fas fa-star" onclick="rate(4)"></i>
                <i class="fas fa-star" onclick="rate(5)"></i>
            </div>

            <textarea class="review-text" placeholder="Ceritakan kepuasanmu tentang kualitas barang dan pengiriman..."></textarea>

            <div class="upload-box" onclick="alert('Fitur buka galeri/kamera')">
                <i class="fas fa-camera camera-icon"></i>
                <span>Tambah Foto/Video</span>
            </div>
        </div>

        <button class="btn-submit" onclick="submitReview()">Kirim Ulasan</button>

    </div>

    <div class="custom-alert-overlay" id="successAlert">
        <div class="custom-alert-box">
            <i class="fas fa-check-circle success-icon"></i>
            <h3>Ulasan Terkirim!</h3>
            <p style="color:#666; font-size:14px;">Terima kasih atas ulasan Anda. Koin Snap Shop Anda telah bertambah!</p>
            <button class="btn-alert" onclick="goToHistory()">OK</button>
        </div>
    </div>

    <script>
        // Logika Bintang
        let currentRating = 0;
        const stars = document.querySelectorAll('.stars i');

        function rate(n) {
            currentRating = n;
            stars.forEach((star, index) => {
                if (index < n) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        // Logika Submit
        function submitReview() {
            if (currentRating === 0) {
                alert("Mohon berikan bintang terlebih dahulu!");
                return;
            }

            // Efek Loading Button
            const btn = document.querySelector('.btn-submit');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            btn.style.opacity = '0.7';

            setTimeout(() => {
                // Tampilkan Alert Sukses
                document.getElementById('successAlert').classList.add('show');
                btn.innerHTML = 'Kirim Ulasan';
                btn.style.opacity = '1';
            }, 1000);
        }

        function goToHistory() {
            window.location.href = 'Riwayat.html';
        }
    </script>

</body>
</html>
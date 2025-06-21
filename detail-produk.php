<?php
require 'koneksi.php';

$kode = $_GET['kode'] ?? '';
$query = $db->prepare("SELECT p.*, k.nama_kategori FROM tb_produk p 
                       JOIN tb_kategori k ON p.id_kategori = k.id_kategori 
                       WHERE kode_produk = ?");
$query->execute([$kode]);
$produk = $query->fetch();

if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($produk['nama_produk']) ?> - Petshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="user/style.css">
    <style>
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 60px;
        }

        .image-container {
            flex: 1;
            min-width: 300px;
        }

        .image-container img {
            width: 100%;
            border-radius: 10px;
        }

        .product-details {
            flex: 2;
            min-width: 300px;
        }

        .product-details h2 {
            margin-top: 0;
            font-size: 28px;
            color: #2E8B57;
        }

        .product-details p {
            font-size: 16px;
            margin: 10px 0;
        }

        .product-details .harga {
            font-size: 24px;
            font-weight: bold;
            color: #D35400;
        }

        .product-details .btn {
            margin-top: 20px;
            display: inline-block;
            background-color: #2E8B57;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .product-details .btn:hover {
            background-color: #246B45;
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';
    ?>

    <div class="container">
        <div class="image-container">
            <img src="images/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
        </div>
        <div class="product-details">
            <h2><?= htmlspecialchars($produk['nama_produk']) ?></h2>
            <p>Kategori: <?= htmlspecialchars($produk['nama_kategori']) ?></p>
            <p class="harga">Rp<?= number_format($produk['harga'], 0, ',', '.') ?></p>
            <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
            <button class="btn" id="tambahKeranjang" data-kode="<?= $produk['kode_produk'] ?>">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        </div>
    </div>

    <?php
    require 'footer.php';
    ?>

    <script src="user/user.js"></script>

    <!-- Script internal khusus halaman ini -->
    <script>
        const isLoggedIn = <?= $isLoggedIn ?>;

        function getCookie(name) {
            const value = "; " + document.cookie;
            const parts = value.split("; " + name + "=");
            if (parts.length === 2) return decodeURIComponent(parts.pop().split(";").shift());
            return null;
        }

        function setCookie(name, value, days = 7) {
            const d = new Date();
            d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = name + "=" + encodeURIComponent(value) + "; expires=" + d.toUTCString() + "; path=/";
        }

        function updateCartCount() {
            const cart = JSON.parse(getCookie('keranjang') || '{}');
            let total = 0;
            for (const kode in cart) {
                total += cart[kode];
            }
            const cartBadge = document.getElementById('cart-count');
            if (cartBadge) {
                cartBadge.textContent = total;
            }
        }

        document.getElementById('tambahKeranjang').addEventListener('click', function() {
            if (!isLoggedIn) {
                alert("Silakan login terlebih dahulu untuk menambahkan ke keranjang.");
                window.location.href = 'auth/LoginForm.php';
                return;
            }

            const kode = this.getAttribute('data-kode');
            let cart = JSON.parse(getCookie('keranjang') || '{}');

            cart[kode] = (cart[kode] || 0) + 1;

            setCookie('keranjang', JSON.stringify(cart));
            updateCartCount();
            alert("Produk ditambahkan ke keranjang!");
        });


        updateCartCount();
    </script>
</body>

</html>
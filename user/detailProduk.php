<?php
session_start();
require '../koneksi.php';

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

// Proses tambah ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_keranjang'])) {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('Silakan login terlebih dahulu untuk menambahkan ke keranjang.');window.location.href='../auth/login.html';</script>";
        exit;
    }

    $id_user = $_SESSION['user']['id_user'];
    $kode_produk = $_POST['kode_produk'];

    // Cek apakah sudah ada di keranjang
    $cek = $db->prepare("SELECT * FROM tb_keranjang WHERE id_user = ? AND kode_produk = ?");
    $cek->execute([$id_user, $kode_produk]);
    $existing = $cek->fetch();

    if ($existing) {
        // Jika sudah ada, tambahkan jumlahnya
        $update = $db->prepare("UPDATE tb_keranjang SET jumlah = jumlah + 1 WHERE id_keranjang = ?");
        $update->execute([$existing['id_keranjang']]);
    } else {
        // Jika belum ada, tambahkan entri baru
        $insert = $db->prepare("INSERT INTO tb_keranjang (id_user, kode_produk, jumlah) VALUES (?, ?, 1)");
        $insert->execute([$id_user, $kode_produk]);
    }

    echo "<script>alert('Produk ditambahkan ke keranjang!');window.location.href='keranjang.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($produk['nama_produk']) ?> - Petshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 1000px;
            margin: 60px auto 40px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
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
    <?php require 'header.php'; ?>

    <div class="container">
        <div class="image-container">
            <img src="../images/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
        </div>
        <div class="product-details">
            <h2><?= htmlspecialchars($produk['nama_produk']) ?></h2>
            <p>Kategori: <?= htmlspecialchars($produk['nama_kategori']) ?></p>
            <p class="harga">Rp<?= number_format($produk['harga'], 0, ',', '.') ?></p>
            <p><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></p>
            <form method="post">
                <input type="hidden" name="kode_produk" value="<?= $produk['kode_produk'] ?>">
                <button type="submit" name="tambah_keranjang" class="btn">
                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>

    <?php require 'footer.php'; ?>

    <!-- Script untuk keranjang -->
    <script src="user.js"></script>
</body>

</html>
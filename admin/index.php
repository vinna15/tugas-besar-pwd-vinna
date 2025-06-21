<?php
require '../koneksi.php';

// jumlah produk
$jumlah_produk = $db->query("SELECT COUNT(*) FROM tb_produk")->fetchColumn();

// Jumlah Pengguna Aktif (misalnya hanya role 'user')
$jumlah_user = $db->query("SELECT COUNT(*) FROM tb_users WHERE role = 'user'")->fetchColumn();

// Jumlah Pesanan Baru (status = 'pending')
$jumlah_pesanan = $db->query("SELECT COUNT(*) FROM tb_transaksi WHERE status = 'pending'")->fetchColumn();

// Jumlah Kategori
$jumlah_kategori = $db->query("SELECT COUNT(*) FROM tb_kategori")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #e9f7ef;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .card h3 {
            margin: 10px 0 5px;
            color: #2E8B57;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-box">
            <h2>Selamat Datang, Admin!</h2>
            <p>Berikut ringkasan data sistem.</p>

            <div class="info-grid">
                <div class="card">
                    <i class="fas fa-box fa-2x"></i>
                    <h3><?= $jumlah_produk ?></h3>
                    <p>Produk Terdaftar</p>
                </div>
                <div class="card">
                    <i class="fas fa-users fa-2x"></i>
                    <h3><?= $jumlah_user ?></h3>
                    <p>Pengguna Aktif</p>
                </div>
                <div class="card">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                    <h3><?= $jumlah_pesanan ?></h3>
                    <p>Pesanan Baru</p>
                </div>
                <div class="card">
                    <i class="fas fa-tags fa-2x"></i>
                    <h3><?= $jumlah_kategori ?></h3>
                    <p>Kategori Produk</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
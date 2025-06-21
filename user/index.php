<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Petshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .banner {
            /* background-color: #2E8B57; */
            margin-top: 100px;
            color: black;
            padding: 20px 20px;
            text-align: center;
        }

        .banner img {
            width: 90%;
            border-radius: 10px;

        }

        .banner h1 {
            margin: 0;
            font-size: 28px;
        }

        .produk-section {
            padding: 40px 20px;
            text-align: center;
        }

        .produk-section h2 {
            color: #2E8B57;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .produk-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .produk-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 15px;
            text-align: left;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .produk-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .produk-item img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            height: 180px;
            object-fit: cover;
        }

        .produk-item h4 {
            margin: 5px 0;
            font-size: 18px;
            color: #2E8B57;
        }

        .produk-item p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .harga {
            font-weight: bold;
            color: #D35400;
            font-size: 16px;
        }

        .btn-lihat {
            display: inline-block;
            margin-top: 30px;
            background-color: #2E8B57;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-lihat:hover {
            background-color: #246B45;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-container input[type="text"] {
                width: 200px;
            }

            .produk-item {
                width: 90%;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .menu {
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
            }

            .search-container {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';
    ?>

    <div class="banner">
        <!-- <h1>Selamat Datang di MecilPets! 🐶🐱</h1> -->
        <img src="../fotoEdit/Pet Shop.png" alt="Banner Petshop">
    </div>

    <!-- Produk Unggulan -->
    <?php
    require '../koneksi.php';

    // Ambil 6 produk terbaru atau produk dengan kondisi tertentu (misalnya unggulan = 1)
    $query = $db->query("SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT 6");
    $produkUnggulan = $query->fetchAll();
    ?>

    <section class="produk-section">
        <h2>Produk</h2>
        <div class="produk-list">
            <?php foreach ($produkUnggulan as $produk): ?>
                <div class="produk-item">
                    <a href="detailProduk.php?kode=<?= $produk['kode_produk'] ?>" style="text-decoration: none; color: inherit;">
                        <img src="../images/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" />
                        <h4><?= htmlspecialchars($produk['nama_produk']) ?></h4>
                        <p><?= htmlspecialchars($produk['deskripsi']) ?></p>
                        <div class="harga">Rp<?= number_format($produk['harga'], 0, ',', '.') ?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="produk.php" class="btn-lihat">Lihat Kategori Produk</a>
    </section>

    <?php
    require 'footer.php';
    ?>

    <script src="user.js"></script>
</body>

</html>
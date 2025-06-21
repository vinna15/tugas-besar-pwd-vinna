<?php
require '../koneksi.php';
$where = "";
if (isset($_GET['kategori']) && $_GET['kategori'] !== "") {
    $kategoriId = $_GET['kategori'];
    $where = "WHERE p.id_kategori = $kategoriId";
}

$queryProduk = $db->query("SELECT p.*, k.nama_kategori FROM tb_produk p JOIN tb_kategori k ON p.id_kategori = k.id_kategori $where ORDER BY k.nama_kategori");

$produkPerKategori = [];
foreach ($queryProduk as $row) {
    $produkPerKategori[$row['nama_kategori']][] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Petshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            margin-top: 70px;
            padding: 0 20px;
        }

        .produk-section {
            max-width: 1200px;
            margin: auto;
            padding: 20px 0;
            box-sizing: border-box;
        }

        .produk-section h2 {
            color: #2E8B57;
            font-size: 24px;
            border-bottom: 2px solid #2E8B57;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        .produk-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            flex-direction: row;
        }

        .produk-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 15px;
            text-align: left;
            transition: transform 0.3s;
        }

        .produk-item:hover {
            transform: translateY(-5px);
        }

        .produk-item img {
            width: 100%;
            border-radius: 8px;
            height: 160px;
            object-fit: cover;
        }

        .produk-item h4 {
            margin: 10px 0 5px;
            font-size: 18px;
            color: #2E8B57;
        }

        .produk-item p {
            font-size: 14px;
            color: #555;
            margin: 0 0 10px;
        }

        .harga {
            font-weight: bold;
            color: #D35400;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';
    ?>

    <div class="container">
        <?php foreach ($produkPerKategori as $kategoriNama => $listProduk): ?>
            <div class="produk-section">
                <h2><?= htmlspecialchars($kategoriNama) ?></h2>
                <div class="produk-list">
                    <?php foreach ($listProduk as $p): ?>
                        <a href="detailProduk.php?kode=<?= $p['kode_produk'] ?>" style="text-decoration: none; color: inherit;">
                        <div class="produk-item">
                            <img src="../images/<?= htmlspecialchars($p['gambar']) ?>" alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                            <h4><?= htmlspecialchars($p['nama_produk']) ?></h4>
                            <p><?= htmlspecialchars($p['deskripsi']) ?></p>
                            <div class="harga">Rp<?= number_format($p['harga'], 0, ',', '.') ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>


    <?php
    require 'footer.php';
    ?>

    <script src="user.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Petshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            margin-top: 80px;
            padding: 20px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            color: #2E8B57;
            border-bottom: 2px solid #2E8B57;
            padding-bottom: 10px;
        }

        .tab-menu {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .tab-menu button {
            padding: 10px 20px;
            border: none;
            background-color: #ddd;
            color: #333;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .tab-menu button.active {
            background-color: #2E8B57;
            color: white;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .pesanan-box {
            background-color: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .pesanan-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .pesanan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .pesanan-item img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }

        .pesanan-info {
            flex-grow: 1;
        }

        .pesanan-info h4 {
            margin: 0 0 5px;
        }

        .pesanan-info p {
            margin: 0;
            font-size: 14px;
            color: #444;
        }

        .pesanan-info p strong {
            font-size: 15px;
            color: #000;
        }

        .status {
            font-weight: bold;
        }

        .pending {
            color: #999;
        }

        .diproses {
            color: #D35400;
        }

        .dikirim {
            color: #2980B9;
        }

        .selesai {
            color: green;
        }

        .btn-selesai {
            margin-top: 15px;
            padding: 8px 15px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-selesai:hover {
            background-color: #256d47;
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';
    require '../koneksi.php';
    session_start();
    $id_user = $_SESSION['user']['id_user'];

    $query = $db->prepare("SELECT t.*, d.jumlah, d.subtotal, p.nama_produk, p.gambar FROM tb_transaksi t
        JOIN tb_detail_transaksi d ON t.id_transaksi = d.id_transaksi
        JOIN tb_produk p ON d.kode_produk = p.kode_produk
        WHERE t.id_user = ? ORDER BY t.tanggal_transaksi DESC");
    $query->execute([$id_user]);
    $pesanan = $query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="tab-menu">
            <button class="tab-btn active" data-target="pending">Pending</button>
            <button class="tab-btn" data-target="diproses">Diproses</button>
            <button class="tab-btn" data-target="dikirim">Dikirim</button>
            <button class="tab-btn" data-target="selesai">Selesai</button>
        </div>

        <?php
        $statusList = ['pending', 'diproses', 'dikirim', 'selesai'];
        foreach ($statusList as $i => $status) {
            echo '<div class="tab-content ' . ($i === 0 ? 'active' : '') . '" id="' . $status . '">';
            foreach ($pesanan as $kode => $items) {
                if ($items[0]['status'] !== $status) continue;
                echo '<div class="pesanan-box">';
                echo '<div class="pesanan-header">';
                echo '<div>Tanggal: ' . date('d M Y', strtotime($items[0]['tanggal_transaksi'])) . '</div>';
                echo '<div class="status ' . $status . '">' . ucfirst($status) . '</div>';
                echo '</div>';

                foreach ($items as $item) {
                    echo '<div class="pesanan-item">';
                    echo '<img src="../images/' . htmlspecialchars($item['gambar']) . '" alt="">';
                    echo '<div class="pesanan-info">';
                    echo '<h4>' . htmlspecialchars($item['nama_produk']) . '</h4>';
                    echo '<p>Jumlah: ' . $item['jumlah'] . ' x Rp' . number_format($item['subtotal'] / $item['jumlah'], 0, ',', '.') . '</p>';
                    echo '<p>Total: <strong>Rp' . number_format($item['subtotal'], 0, ',', '.') . '</strong></p>';
                    echo '</div>';
                    if ($status === 'dikirim') {
                        echo '<form method="POST" action="update_status.php">';
                        echo '<input type="hidden" name="id_transaksi" value="' . $kode . '">';
                        echo '<button type="submit" class="btn-selesai">Pesanan Diterima</button>';
                        echo '</form>';
                    }
                    echo '</div>';
                }

                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <?php require 'footer.php'; ?>

    <script src="user.js"></script>
    <script>
        const buttons = document.querySelectorAll(".tab-btn");
        const contents = document.querySelectorAll(".tab-content");

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                buttons.forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");

                const target = button.getAttribute("data-target");
                contents.forEach(content => {
                    content.classList.remove("active");
                    if (content.id === target) {
                        content.classList.add("active");
                    }
                });
            });
        });
    </script>
</body>

</html>
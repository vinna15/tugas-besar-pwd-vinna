<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .tab-menu {
            display: flex;
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

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn-status,
        .btn-hapus {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 13px;
        }

        .btn-status {
            background-color: #17a2b8;
        }

        .btn-hapus {
            background-color: #dc3545;
        }

        .btn-status:hover {
            background-color: #138496;
        }

        .btn-hapus:hover {
            background-color: #c82333;
        }

        .status-pending {
            color: gray;
            font-weight: bold;
        }

        .status-proses {
            color: orange;
            font-weight: bold;
        }

        .status-kirim {
            color: blue;
            font-weight: bold;
        }

        .status-selesai {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php 
    require 'header.php';
    require '../koneksi.php';
    $query = $db->query("SELECT * FROM tb_transaksi ORDER BY tanggal_transaksi DESC");
    $transaksi = $query->fetchAll();
    ?>

    <div class="main-content">
        <div class="dashboard-box">
            <h2>Data Pesanan</h2>

            <div class="tab-menu">
                <button class="tab-btn active" data-target="pending">Pending</button>
                <button class="tab-btn" data-target="diproses">Diproses</button>
                <button class="tab-btn" data-target="dikirim">Dikirim</button>
                <button class="tab-btn" data-target="selesai">Selesai</button>
            </div>

            <?php
            $statusList = ['pending', 'diproses', 'dikirim', 'selesai'];
            foreach ($statusList as $i => $status) {
                echo '<div id="' . $status . '" class="tab-content ' . ($i === 0 ? 'active' : '') . '">';
                echo '<table><thead><tr><th>ID Pesanan</th><th>Tanggal</th><th>Nama Pelanggan</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead><tbody>';

                foreach ($transaksi as $t) {
                    if ($t['status'] !== $status) continue;
                    echo '<tr>';
                    echo '<td>' . $t['id_transaksi'] . '</td>';
                    echo '<td>' . date('Y-m-d', strtotime($t['tanggal_transaksi'])) . '</td>';
                    echo '<td>' . htmlspecialchars($t['nama_penerima']) . '</td>';
                    echo '<td>Rp ' . number_format($t['total_harga'], 0, ',', '.') . '</td>';
                    echo '<td class="status-' . $status . '">' . ucfirst($status) . '</td>';
                    echo '<td>';
                    echo '<form action="ubah_status.php" method="POST" style="display:inline-block">';
                    echo '<input type="hidden" name="id_transaksi" value="' . $t['id_transaksi'] . '">';
                    if ($status === 'pending') {
                        echo '<button class="btn-status" name="aksi" value="diproses"><i class="fa-solid fa-play"></i> Proses</button>';
                    } elseif ($status === 'diproses') {
                        echo '<button class="btn-status" name="aksi" value="dikirim"><i class="fa-solid fa-share-from-square"></i> Kirim</button>';
                    } elseif ($status === 'dikirim') {
                        echo '<button class="btn-status" name="aksi" value="selesai"><i class="fa-solid fa-check"></i> Selesaikan</button>';
                    }
                    echo '</form> ';
                    echo '<form action="hapus_transaksi.php" method="POST" style="display:inline-block">';
                    echo '<input type="hidden" name="id_transaksi" value="' . $t['id_transaksi'] . '">';
                    echo '<button class="btn-hapus" onclick="return confirm(\'Yakin ingin menghapus?\')"><i class="fas fa-trash-alt"></i> Hapus</button>';
                    echo '</form>';
                    echo '</td></tr>';
                }

                echo '</tbody></table></div>';
            }
            ?>
        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                contents.forEach(c => c.classList.remove('active'));
                const target = this.getAttribute('data-target');
                document.getElementById(target).classList.add('active');
            });
        });
    </script>
</body>

</html>
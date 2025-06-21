<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .filter-box {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
        }

        .filter-box input[type="date"] {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-filter,
        .btn-export {
            padding: 8px 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        .btn-export {
            background-color: #28a745;
        }

        .btn-filter:hover {
            background-color: #0056b3;
        }

        .btn-export:hover {
            background-color: #218838;
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
    </style>
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-box">
            <h2>Laporan Penjualan</h2>

            <div class="filter-box">
                <label for="tgl_awal">Dari Tanggal:</label>
                <input type="date" id="tgl_awal" name="tgl_awal">
                <label for="tgl_akhir">Sampai Tanggal:</label>
                <input type="date" id="tgl_akhir" name="tgl_akhir">
                <button class="btn-filter"><i class="fas fa-search"></i> Tampilkan</button>
                <button class="btn-export"><i class="fas fa-file-export"></i> Export</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TRX001</td>
                        <td>2025-06-16</td>
                        <td>Andi Saputra</td>
                        <td>Dog Food Premium</td>
                        <td>2</td>
                        <td>Rp 240.000</td>
                    </tr>
                    <tr>
                        <td>TRX002</td>
                        <td>2025-06-17</td>
                        <td>Siti Rahma</td>
                        <td>Kandang Kucing Besi</td>
                        <td>1</td>
                        <td>Rp 500.000</td>
                    </tr>
                    <!-- Tambahkan baris lainnya jika perlu -->
                </tbody>
                <tfoot>
                    <tr style="background-color:#f1f1f1; font-weight: bold;">
                        <td colspan="4" style="text-align: right;">Total</td>
                        <td>3</td> <!-- Total jumlah -->
                        <td>Rp 740.000</td> <!-- Total penjualan -->
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>

</html>
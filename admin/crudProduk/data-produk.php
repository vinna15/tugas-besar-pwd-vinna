<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        .btn-tambah {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-tambah:hover {
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

        .btn-edit,
        .btn-hapus {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-hapus {
            background-color: #dc3545;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-hapus:hover {
            background-color: #c82333;
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
            <h2>Kelola Produk</h2>

            <a href="tambah-produk.php" class="btn-tambah"><i class="fas fa-plus"></i> Tambah Produk</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../../koneksi.php';
                    $no = 1;
                    $query = $db->prepare('SELECT p.kode_produk, p.nama_produk, p.harga, p.stok, p.gambar, k.nama_kategori FROM tb_produk AS p INNER JOIN tb_kategori AS k ON p.id_kategori = k.id_kategori ');
                    $query->execute();
                    $produk = $query->fetchAll();
                    foreach ($produk as $p) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $p['kode_produk'] ?></td>
                            <td><?php echo $p['nama_produk'] ?></td>
                            <td><?php echo $p['nama_kategori'] ?></td>
                            <td><?php echo $p['harga'] ?></td>
                            <td><?php echo $p['stok'] ?></td>
                            <td><img src="../../images/<?= "$p[gambar]" ?>" alt="Produk" width="60" /></td>
                            <td>
                                <a href="edit-produk.php?kode=<?= $p['kode_produk']; ?>" class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit</a>
                                <a href="delete.php?kode=<?= $p['kode_produk']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus produk ini?');">
                                    <i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                    <!-- Tambah baris produk lainnya di sini -->
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
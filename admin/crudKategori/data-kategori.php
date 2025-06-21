<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        form{
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .btn-simpan {
            margin-top: 10px;
            background-color: #28a745;
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
            <h2>Kelola Kategori Produk</h2>

            <!-- Form Tambah Kategori -->
            <form action="insert.php" method="post">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" required>
                </div>
                <button type="submit" class="btn-simpan"><i class="fas fa-plus"></i> Tambah Kategori</button>
            </form>

            <!-- Daftar Kategori -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../../koneksi.php';
                    $no = 1;
                    $query = $db->prepare('SELECT * FROM tb_kategori');
                    $query->execute();
                    $kategori = $query->fetchAll();
                    foreach($kategori as $k){
                    ?>
                    <!-- Contoh data kategori -->
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $k['nama_kategori']; ?></td>
                        <td>
                            <div class="action-btn">
                                <a href="edit-kategori.php?id_kategori=<?php echo $k['id_kategori'];?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete.php?id_kategori=<?php echo $k['id_kategori'];?>" onclick="return confirm('Yakin?')" class="btn-hapus"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        $no++;
                        }
                    ?>
                    <!-- Tambahkan data kategori dari database secara dinamis di sini -->
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
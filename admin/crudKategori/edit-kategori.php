<?php
    require '../../koneksi.php';

    $idKategori = $_GET['id_kategori'];
    $query = $db->prepare('SELECT * FROM tb_kategori WHERE id_kategori = ?');
    $query->execute([$idKategori]);
    $kategori = $query->fetch();

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        form {
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
            <form action="update.php" method="post">
                <input type="hidden" name="id_kategori" value="<?php echo $kategori['id_kategori'];?>">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>"required>
                </div>
                <button type="submit" class="btn-simpan"><i class="fas fa-plus"></i> Perbarui</button>
            </form>
        </div>
    </div>

</body>

</html>
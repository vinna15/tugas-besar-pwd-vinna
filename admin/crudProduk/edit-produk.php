<?php
require '../../koneksi.php';

$idProduk = $_GET['kode'];
$query = $db->prepare('SELECT * FROM tb_produk WHERE kode_produk = ?');
$query->execute([$idProduk]);
$produk = $query->fetch();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="file"] {
            margin-top: 8px;
        }

        textarea {
            resize: vertical;
        }

        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .btn-simpan {
            background-color: #28a745;
        }

        .btn-reset {
            background-color: #dc3545;
        }

        .btn-simpan:hover {
            background-color: #218838;
        }

        .btn-reset:hover {
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
            <h2>Tambah Produk</h2>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="kodeProduk" value="<?php echo $produk['kode_produk']; ?>">

                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" id="nama" name="nama_produk" value="<?= $produk['nama_produk'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori_produk" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        require '../../koneksi.php';
                        $query = $db->prepare('SELECT * FROM tb_kategori');
                        $query->execute();
                        $kategori = $query->fetchAll();
                        foreach ($kategori as $k) {
                            $selected = $produk['id_kategori'] == $k['id_kategori'] ? 'selected' : '';
                            echo '<option value="' . $k['id_kategori'] . '" ' . $selected . '>' . $k['nama_kategori'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" min="0" value="<?= $produk['harga'] ?>"required>
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" min="0" value="<?= $produk['stok'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Produk</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" ><?= $produk['deskripsi'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar Produk</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                    <p><small>Biarkan kosong jika tidak ingin mengubah gambar</small></p>
                    <img src="../../images/<?= $produk['gambar']; ?>" width="100">
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-simpan"><i class="fas fa-save"></i> Perbarui</button>
                    <button type="reset" class="btn-reset"><i class="fas fa-undo"></i> Reset</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
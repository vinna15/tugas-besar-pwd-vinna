<?php
session_start();
require '../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href='../auth/LoginForm.html';</script>";
    exit;
}

$id_user = $_SESSION['user']['id_user'];

// Ambil data user
$query_user = $db->prepare("SELECT nama, alamat, no_hp FROM tb_users WHERE id_user = ?");
$query_user->execute([$id_user]);
$data_user = $query_user->fetch();

// Ambil data produk yang dipilih dari keranjang
$produk_data = json_decode($_POST['produk_data'] ?? '[]', true);

if (empty($produk_data)) {
    echo "<script>alert('Tidak ada produk yang dipilih untuk checkout.'); window.location.href='keranjang.php';</script>";
    exit;
}

$idList = array_column($produk_data, 'id_keranjang');
$placeholders = implode(',', array_fill(0, count($idList), '?'));
$query = $db->prepare("SELECT k.*, p.nama_produk, p.harga FROM tb_keranjang k JOIN tb_produk p ON k.kode_produk = p.kode_produk WHERE k.id_user = ? AND k.id_keranjang IN ($placeholders)");
$params = array_merge([$id_user], $idList);
$query->execute($params);
$items = $query->fetchAll();

$total = 0;
foreach ($items as $item) {
    $total += $item['harga'] * $item['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - MecilPets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 900px;
            margin: 100px auto 40px;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #2E8B57;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .checkout-summary {
            margin-top: 30px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
        }
        .checkout-summary h3 {
            margin-bottom: 10px;
            color: #2E8B57;
        }
        .checkout-summary ul {
            list-style: none;
            padding: 0;
        }
        .checkout-summary li {
            margin-bottom: 8px;
        }
        .total {
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-checkout {
            background-color: #2E8B57;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn-checkout:hover {
            background-color: #246B45;
        }
    </style>
</head>
<body>
<?php require 'header.php'; ?>

<div class="container">
    <h2>Checkout</h2>

    <form action="proses_checkout.php" method="POST">
        <input type="hidden" name="produk_data" value='<?= json_encode($produk_data) ?>'>
        <div class="form-group">
            <label for="nama">Nama Penerima</label>
            <input type="text" id="nama" name="nama" required value="<?= htmlspecialchars($data_user['nama']) ?>">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat Pengiriman</label>
            <textarea id="alamat" name="alamat" rows="4" required><?= htmlspecialchars($data_user['alamat']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="telepon">Nomor Telepon</label>
            <input type="text" id="telepon" name="telepon" required value="<?= htmlspecialchars($data_user['no_hp']) ?>">
        </div>

        <div class="form-group">
            <label for="metode">Metode Pembayaran</label>
            <select id="metode" name="metode" required>
                <option value="">-- Pilih --</option>
                <option value="COD">Bayar di Tempat (COD)</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <div class="checkout-summary">
            <h3>Ringkasan Pesanan</h3>
            <ul>
                <?php foreach ($items as $item): ?>
                    <li><?= htmlspecialchars($item['nama_produk']) ?> x<?= $item['jumlah'] ?> - Rp<?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></li>
                <?php endforeach; ?>
            </ul>
            <p class="total">Total: <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></p>
        </div>

        <button type="submit" class="btn-checkout">Konfirmasi & Bayar</button>
    </form>
</div>

<?php require 'footer.php'; ?>
</body>
</html>

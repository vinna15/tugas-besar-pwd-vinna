<?php
session_start();
require '../koneksi.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href='../auth/LoginForm.html';</script>";
    exit;
}

$id_user = $_SESSION['user']['id_user'];

$nama = $_POST['nama'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$telepon = $_POST['telepon'] ?? '';
$metode = $_POST['metode'] ?? '';
$produk_data = json_decode($_POST['produk_data'] ?? '[]', true);

if (!$produk_data || empty($metode)) {
    echo "<script>alert('Data tidak lengkap.'); window.location.href='keranjang.php';</script>";
    exit;
}

$total_harga = 0;
$kode_transaksi = 'TRX' . time(); // kode unik berdasarkan timestamp

// Simpan ke tb_transaksi
$stmt = $db->prepare("INSERT INTO tb_transaksi (id_user, nama_penerima, alamat_pengiriman, no_telp, metode_pembayaran, total_harga, status, tanggal_transaksi) 
                      VALUES (?, ?, ?, ?, ?, 0, 'pending', NOW())");
$stmt->execute([$id_user, $nama, $alamat, $telepon, $metode]);
$id_transaksi = $db->lastInsertId();

// Proses setiap item
foreach ($produk_data as $p) {
    $id_keranjang = $p['id_keranjang'];
    $jumlah = $p['jumlah'];

    $q = $db->prepare("SELECT k.*, p.harga, p.stok FROM tb_keranjang k 
                       JOIN tb_produk p ON k.kode_produk = p.kode_produk 
                       WHERE k.id_keranjang = ? AND k.id_user = ?");
    $q->execute([$id_keranjang, $id_user]);
    $item = $q->fetch();

    if ($item) {
        // Validasi stok cukup
        if ($item['stok'] < $jumlah) {
            echo "<script>alert('Stok produk \"" . htmlspecialchars($item['kode_produk']) . "\" tidak mencukupi.'); window.location.href='keranjang.php';</script>";
            exit;
        }

        $subtotal = $item['harga'] * $jumlah;
        $total_harga += $subtotal;

        // Simpan ke detail transaksi
        $ins = $db->prepare("INSERT INTO tb_detail_transaksi (id_transaksi, kode_produk, jumlah, harga, subtotal) 
                             VALUES (?, ?, ?, ?, ?)");
        $ins->execute([$id_transaksi, $item['kode_produk'], $jumlah, $item['harga'], $subtotal]);

        // Kurangi stok produk
        $updateStok = $db->prepare("UPDATE tb_produk SET stok = stok - ? WHERE kode_produk = ?");
        $updateStok->execute([$jumlah, $item['kode_produk']]);

        // Hapus dari keranjang
        $del = $db->prepare("DELETE FROM tb_keranjang WHERE id_keranjang = ?");
        $del->execute([$id_keranjang]);
    }
}

// Update total harga di tb_transaksi
$upd = $db->prepare("UPDATE tb_transaksi SET total_harga = ? WHERE id_transaksi = ?");
$upd->execute([$total_harga, $id_transaksi]);

echo "<script>alert('Checkout berhasil!'); window.location.href='pesanan.php';</script>";

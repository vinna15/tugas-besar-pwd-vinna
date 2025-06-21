<?php
session_start();
require '../koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'unauthorized']);
    exit;
}

$id_user = $_SESSION['user_id'];
$kode_produk = $_POST['kode_produk'] ?? '';

if (!$kode_produk) {
    echo json_encode(['status' => 'invalid']);
    exit;
}

// Cek apakah produk sudah ada di keranjang user
$cek = $db->prepare("SELECT * FROM keranjang WHERE id_user = ? AND kode_produk = ?");
$cek->execute([$id_user, $kode_produk]);
$item = $cek->fetch();

if ($item) {
    // Update jumlah
    $update = $db->prepare("UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_user = ? AND kode_produk = ?");
    $update->execute([$id_user, $kode_produk]);
} else {
    // Tambah baru
    $insert = $db->prepare("INSERT INTO keranjang (id_user, kode_produk, jumlah) VALUES (?, ?, 1)");
    $insert->execute([$id_user, $kode_produk]);
}

echo json_encode(['status' => 'success']);

<?php
session_start();
require '../koneksi.php';

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href='../auth/LoginForm.html';</script>";
    exit;
}

$id_user = $_SESSION['user']['id_user'];
$id_transaksi = $_POST['id_transaksi'] ?? null;

if (!$id_transaksi) {
    echo "<script>alert('ID Transaksi tidak ditemukan.'); history.back();</script>";
    exit;
}

// Validasi bahwa transaksi milik user ini
$stmt = $db->prepare("SELECT * FROM tb_transaksi WHERE id_transaksi = ? AND id_user = ?");
$stmt->execute([$id_transaksi, $id_user]);
$transaksi = $stmt->fetch();

if (!$transaksi) {
    echo "<script>alert('Transaksi tidak valid.'); history.back();</script>";
    exit;
}

// Update status ke selesai
$update = $db->prepare("UPDATE tb_transaksi SET status = 'selesai' WHERE id_transaksi = ?");
$update->execute([$id_transaksi]);

echo "<script>alert('Pesanan berhasil dikonfirmasi.'); window.location.href='pesanan.php';</script>";

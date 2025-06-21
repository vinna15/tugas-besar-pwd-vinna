<?php
session_start();
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $id_user = $_SESSION['user']['id_user'];
    $id_keranjang = $_POST['id'] ?? null;
    $jumlah = $_POST['jumlah'] ?? 1;

    // Pastikan jumlah tidak kurang dari 1
    $jumlah = max(1, (int)$jumlah);

    // Update ke database
    $stmt = $db->prepare("UPDATE tb_keranjang SET jumlah = ? WHERE id_keranjang = ? AND id_user = ?");
    $success = $stmt->execute([$jumlah, $id_keranjang, $id_user]);

    echo $success ? 'ok' : 'error';
} else {
    echo 'unauthorized';
}

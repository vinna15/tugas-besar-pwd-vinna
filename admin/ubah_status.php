<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'] ?? null;
    $aksi = $_POST['aksi'] ?? null;

    if ($id_transaksi && $aksi) {
        $stmt = $db->prepare("UPDATE tb_transaksi SET status = ? WHERE id_transaksi = ?");
        $stmt->execute([$aksi, $id_transaksi]);
    }
}

header("Location: data-pesanan.php"); // atau nama file admin kamu
exit;
?>

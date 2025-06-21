<?php
session_start();
require '../koneksi.php';

if (isset($_GET['id']) && isset($_SESSION['user'])) {
    $id = $_GET['id'];
    $id_user = $_SESSION['user']['id_user'];

    $stmt = $db->prepare("DELETE FROM tb_keranjang WHERE id_keranjang = ? AND id_user = ?");
    $stmt->execute([$id, $id_user]);
}
?>
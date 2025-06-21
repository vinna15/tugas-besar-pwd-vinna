<?php 
require '../../koneksi.php';

$kodeProduk = $_GET['kode'];
$query = $db->prepare('DELETE FROM tb_produk WHERE kode_produk = ?');
$query->execute([$kodeProduk]);

header('location: data-produk.php');
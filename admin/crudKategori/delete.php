<?php 
require '../../koneksi.php';

$idKategori = $_GET['id_kategori'];
$query = $db->prepare('DELETE FROM tb_kategori WHERE id_kategori = ?');
$query->execute([$idKategori]);

header('location: data-kategori.php');
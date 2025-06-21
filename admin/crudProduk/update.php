<?php
require '../../koneksi.php';

$kodeProduk = $_POST['kodeProduk'];
$namaProduk = $_POST['nama_produk'];
$Kategori = $_POST['kategori_produk'];
$hargaProduk = $_POST['harga'];
$stok = $_POST['stok'];
$dekripsi = $_POST['deskripsi'];
$gambar = $_FILES['gambar']['name'];

if (!empty($gambar)) {
    $path = "../../images/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $path);

    $query = $db->prepare('UPDATE tb_produk SET nama_produk = ?, deskripsi = ?, harga = ?, stok = ?, gambar = ?, id_kategori = ? WHERE kode_produk = ?');
    $query->execute([$namaProduk, $dekripsi, $hargaProduk, $stok, $gambar, $Kategori, $kodeProduk]);
}else{
    $query = $db->prepare('UPDATE tb_produk SET nama_produk = ?, deskripsi = ?, harga = ?, stok = ?, id_kategori = ? WHERE kode_produk = ?');
    $query->execute([$namaProduk, $dekripsi, $hargaProduk, $stok, $Kategori, $kodeProduk]);
}




header('location:data-produk.php');

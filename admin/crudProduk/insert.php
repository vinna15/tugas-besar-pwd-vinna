<?php
    require '../../koneksi.php';

    $kodeProduk = $_POST['kodeProduk'];
    $namaProduk = $_POST['nama_produk'];
    $Kategori = $_POST['kategori_produk'];
    $hargaProduk = $_POST['harga'];
    $stok = $_POST['stok'];
    $dekripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];

    $path = "../../images/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $path );

    $query = $db->prepare('INSERT INTO tb_produk(kode_produk, nama_produk, deskripsi, harga, stok, gambar, id_kategori) VALUES(?,?,?,?,?,?,?)');
    $query->execute([$kodeProduk, $namaProduk, $dekripsi, $hargaProduk, $stok, $gambar, $Kategori]);

    header('location: data-produk.php');
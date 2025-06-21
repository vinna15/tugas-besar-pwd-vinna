<?php
    require '../../koneksi.php';

    $nama_kategori = $_POST['nama_kategori'];

    $query = $db->prepare('INSERT INTO tb_kategori(nama_kategori) VALUES(?)');
    $query->execute([$nama_kategori]);

    header('location: data-kategori.php');
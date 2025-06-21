<?php
    require '../../koneksi.php';

    $idKategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];


    $query = $db->prepare('UPDATE tb_kategori SET nama_kategori = ? WHERE id_kategori = ?');
    $query->execute([$nama_kategori, $idKategori]);

    header('location:data-kategori.php');
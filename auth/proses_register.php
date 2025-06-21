<?php
require '../koneksi.php'; // Sesuaikan path koneksi jika berbeda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $alamat   = trim($_POST['alamat']);
    $no_hp    = trim($_POST['no_hp']);

    // Validasi: cek apakah email atau username sudah digunakan
    $cek = $db->prepare("SELECT * FROM tb_users WHERE email = ? OR username = ?");
    $cek->execute([$email, $username]);
    if ($cek->fetch()) {
        echo "<script>alert('Email atau username sudah digunakan!'); 
        window.location.href = 'FormRegis.php';</script>";
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database (dengan role default 'user')
    $stmt = $db->prepare("INSERT INTO tb_users (nama, username, email, password, alamat, no_hp, role) VALUES (?, ?, ?, ?, ?, ?, 'user')");
    $sukses = $stmt->execute([$nama, $username, $email, $hashedPassword, $alamat, $no_hp]);

    if ($sukses) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); 
        window.location.href = 'LoginForm.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data!'); 
        window.location.href = 'FormRegis.php';</script>";
    }
} else {
    header("Location: FormRegis.php");
    exit;
}

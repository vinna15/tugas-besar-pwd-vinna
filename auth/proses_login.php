<?php
session_start();
require '../koneksi.php'; // Pastikan file ini menginisialisasi koneksi PDO ke $db

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        echo "<script>alert('Email dan password harus diisi!'); 
        window.location.href='LoginForm.php';</script>";
        exit;
    }

    // Ambil data user berdasarkan email
    $query = $db->prepare("SELECT * FROM tb_users WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil
        $_SESSION['user'] = [
            'id_user' => $user['id_user'],
            'nama'    => $user['nama'],
            'email'   => $user['email'],
            'username'=> $user['username'],
            'role'    => $user['role']
        ];

        // Arahkan sesuai role
        if ($user['role'] === 'admin') {
            header('Location: ../admin/index.php');
        } else {
            header('Location: ../user/index.php');
        }
        exit;
    } else {
        // Login gagal
        echo "<script>alert('Email atau password salah!'); 
        window.location.href='LoginForm.php';</script>";
        exit;
    }
} else {
    // Jika bukan metode POST
    header('Location: LoginForm.php');
    exit;
}

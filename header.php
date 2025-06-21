<?php 
session_start();
$isLoggedIn = isset($_SESSION['user']) ? 'true' : 'false';
?>
<div class="navbar">
        <div class="logo">
            <img src="fotoEdit/paws.png" alt="Logo Paws" />
            <div class="logo-text">
                <p class="mecil">Mecil</p>
                <p class="pets">Pets</p>
            </div>
        </div>

        <div class="search-container">
            <form action="pencarian.php" method="get">
                <input type="text" name="search" placeholder="Cari produk..." />
                <button type="submit">Cari</button>
            </form>
        </div>

        <div class="menu">
            <a href="index.php">Beranda</a>
            <a href="katalog-produk.php">Produk</a>
            <a href="keranjang.php">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>

            <a href="auth/LoginForm.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            <a href="auth/FormRegis.php"><i class="fa-solid fa-user-plus"></i> Daftar</a>
        </div>
    </div>
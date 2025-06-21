<?php
session_start();
require '../koneksi.php'; // sesuaikan jika path berbeda

$cartCount = 0;
if (isset($_SESSION['user'])) {
    $stmt = $db->prepare("SELECT SUM(jumlah) FROM tb_keranjang WHERE id_user = ?");
    $stmt->execute([$_SESSION['user']['id_user']]);
    $cartCount = $stmt->fetchColumn() ?? 0;
}
$username = $_SESSION['user']['username'] ?? 'user';

?>
<div class="navbar">
    <div class="logo">
        <img src="../fotoEdit/paws.png" alt="Logo Paws" />
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
        <a href="produk.php">Produk</a>
        <a href="keranjang.php">
            <i class="fas fa-shopping-cart"></i>
            <span id="cart-count"><?= $cartCount ?></span>
        </a>

        <div class="dropdown" id="dropdownProfil">
            <button class="dropdown-toggle" onclick="toggleDropdown(event)">
                <i class="fa-solid fa-user"></i>
                <span><?= htmlspecialchars($username) ?> ▼</span>
            </button>
            <div class="dropdown-menu">
                <a href="profil.html">Detail Profil</a>
                <a href="pesanan.php">Pesanan</a>
                <a href="../auth/logout.php" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
            </div>
        </div>
    </div>
</div>
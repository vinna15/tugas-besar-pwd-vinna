<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Petshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            margin: 0;
            font-family: Arial;
            font-size: 15px;
        }

        .navbar {
            background-color: #2E8B57;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            flex-wrap: wrap;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-sizing: border-box;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 40px;
            color: #d5f5e3;
        }

        .logo-text {
            display: flex;
            flex-direction: row;
            line-height: 1;
        }

        .logo-text .mecil {
            color: white;
            font-weight: bold;
            font-size: 25px;
            margin: 0;
        }

        .logo-text .pets {
            color: #FFD700;
            /* kuning keemasan */
            font-weight: bold;
            font-size: 20px;
            margin: 0;
        }

        .menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .menu a {
            color: white;
            padding: 10px;
            text-decoration: none;
        }

        .menu a:hover {
            background-color: #246B45;
            border-radius: 5px;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-container input[type="text"] {
            padding: 6px 10px;
            border-radius: 5px;
            border: none;
            width: 350px;
        }

        .search-container button {
            padding: 6px 12px;
            border: none;
            background-color: #fff;
            color: #2E8B57;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-container button:hover {
            background-color: #d5f5e3;
        }

        .cart-count {
            background: red;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
            position: relative;
            top: -10px;
            right: 10px;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            background: none;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 45px;
            right: 0;
            background-color: white;
            min-width: 150px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            z-index: 1;
        }

        .dropdown-menu a {
            color: #2E8B57;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }

        .dropdown.active .dropdown-menu {
            display: block;
        }

        .banner {
            /* background-color: #2E8B57; */
            margin-top: 100px;
            color: black;
            padding: 20px 20px;
            text-align: center;
        }

        .banner img {
            width: 90%;
            border-radius: 10px;

        }

        .banner h1 {
            margin: 0;
            font-size: 28px;
        }

        .produk-section {
            padding: 40px 20px;
            text-align: center;
        }

        .produk-section h2 {
            color: #2E8B57;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .produk-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .produk-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 15px;
            text-align: left;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .produk-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .produk-item img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            height: 180px;
            object-fit: cover;
        }

        .produk-item h4 {
            margin: 5px 0;
            font-size: 18px;
            color: #2E8B57;
        }

        .produk-item p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .harga {
            font-weight: bold;
            color: #D35400;
            font-size: 16px;
        }

        .btn-lihat {
            display: inline-block;
            margin-top: 30px;
            background-color: #2E8B57;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-lihat:hover {
            background-color: #246B45;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-container input[type="text"] {
                width: 200px;
            }

            .produk-item {
                width: 90%;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .menu {
                flex-wrap: wrap;
                justify-content: center;
                width: 100%;
            }

            .search-container {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
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
            <a href="keranjang.html">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>

            <a href="auth/LoginForm.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            <a href="auth/FormRegis.php"><i class="fa-solid fa-user-plus"></i> Daftar</a>
        </div>
    </div>

    <div class="banner">
        <!-- <h1>Selamat Datang di MecilPets! 🐶🐱</h1> -->
        <img src="fotoEdit/Pet Shop.png" alt="Banner Petshop">
    </div>

    <?php
    require 'koneksi.php';

    // Ambil 6 produk terbaru atau produk dengan kondisi tertentu (misalnya unggulan = 1)
    $query = $db->query("SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT 6");
    $produkUnggulan = $query->fetchAll();
    ?>

    <section class="produk-section">
        <h2>Produk</h2>
        <div class="produk-list">
            <?php foreach ($produkUnggulan as $produk): ?>
                <a href="detail-produk.php?kode=<?= $produk['kode_produk'] ?>" style="text-decoration: none; color: inherit;">
                <div class="produk-item">
                    <img src="images/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" />
                    <h4><?= htmlspecialchars($produk['nama_produk']) ?></h4>
                    <p><?= htmlspecialchars($produk['deskripsi']) ?></p>
                    <div class="harga">Rp<?= number_format($produk['harga'], 0, ',', '.') ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="katalog-produk.php" class="btn-lihat">Lihat Kategori Produk</a>
    </section>

    <footer style="background-color: #2E8B57; color: white; padding: 20px 0; text-align: center; margin-top: 40px;">
        <div style="max-width: 1000px; margin: 0 auto;">
            <p style="margin: 5px 0;">&copy; 2025 MecilPets. Semua Hak Dilindungi.</p>
            <p style="margin: 5px 0;">Jl. Ir Juanda, Cianjur, Jawa Barat - Indonesia</p>
            <p style="margin: 5px 0;">
                Hubungi kami: <a href="mailto:support@mecilpets.com" style="color: #FFD700;">support@mecilpets.com</a> |
                <a href="tel:+6281234567890" style="color: #FFD700;">+62 812-3456-7890</a>
            </p>
            <div style="margin-top: 10px;">
                <a href="#" style="color: white; margin: 0 10px;"><i class="fab fa-facebook"></i></a>
                <a href="#" style="color: white; margin: 0 10px;"><i class="fab fa-instagram"></i></a>
                <a href="#" style="color: white; margin: 0 10px;"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            document.getElementById("dropdownProfil").classList.toggle("active");
        }

        window.onclick = function(event) {
            if (!event.target.closest(".dropdown")) {
                document.getElementById("dropdownProfil").classList.remove("active");
            }
        };
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Petshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            flex: 1;
            margin-top: 70px;
            padding: 20px;
        }

        .kategori-section h2 {
            text-align: center;
            color: #2E8B57;
            font-size: 26px;
            margin-bottom: 30px;
        }

        .kategori-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .kategori-item {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s;
            text-decoration: none;
            color: #2E8B57;
        }

        .kategori-item:hover {
            transform: translateY(-5px);
            background-color: #e8f5e9;
        }

        .kategori-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .kategori-item h3 {
            margin-top: 15px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <?php 
        require 'header.php';
    ?>

    <div class="container">
        <h2>Kategori Produk</h2>
        <div class="kategori-list">
            <a href="produk.html#Makanan" class="kategori-item">
                <img src="https://images.unsplash.com/photo-1615397349302-f3a4bb09655a" alt="Makanan">
                <h3>Makanan</h3>
            </a>
            <a href="produk.html#Aksesoris" class="kategori-item">
                <img src="https://images.unsplash.com/photo-1603400529392-98a62b3a0671" alt="Aksesoris">
                <h3>Aksesoris</h3>
            </a>
            <a href="produk.html#Vitamin" class="kategori-item">
                <img src="https://images.unsplash.com/photo-1601312036962-0ff3db5419bd" alt="Vitamin">
                <h3>Vitamin</h3>
            </a>
        </div>
    </div>

    <?php 
        require 'footer.php'
    ?>

    <script src="user.js"></script>
</body>

</html>
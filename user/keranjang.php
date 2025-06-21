<?php
session_start();
require '../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href='../auth/LoginForm.html';</script>";
    exit;
}

$id_user = $_SESSION['user']['id_user'];

// Ambil data keranjang user dengan JOIN ke tb_produk
$query = $db->prepare("SELECT k.*, p.nama_produk, p.harga, p.gambar FROM tb_keranjang k JOIN tb_produk p ON k.kode_produk = p.kode_produk WHERE k.id_user = ?");
$query->execute([$id_user]);
$items = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            margin-top: 80px;
            padding: 20px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }

        button {
            padding: 6px 12px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #246B45;
        }
    </style>
</head>

<body>
    <?php require 'header.php'; ?>

    <div class="container">
        <h2>Keranjang Belanja</h2>
        <form id="checkoutForm" action="checkout.php" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr data-id="<?= $item['id_keranjang'] ?>">
                            <td><input type="checkbox" class="pilih-produk"></td>
                            <td><img src="../images/<?= htmlspecialchars($item['gambar']) ?>" width="80"></td>
                            <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                            <td class="harga"><?= $item['harga'] ?></td>
                            <td><input type="number" class="jumlah" value="<?= $item['jumlah'] ?>" min="1" onchange="updateTotal(this)"></td>
                            <td class="total-item"><?= $item['harga'] * $item['jumlah'] ?></td>
                            <td><button type="button" onclick="hapusItem(this)">Hapus</button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total">Total Belanja: Rp 0</div>

            <input type="hidden" name="produk_data" id="produk_data">
            <div style="text-align: right;">
                <button type="submit">Checkout yang Dipilih</button>
            </div>
        </form>
    </div>

    <?php require 'footer.php'; ?>

    <script src="user.js"></script>
    <script>
        function updateTotal(input) {
            const row = input.closest('tr');
            const idKeranjang = row.dataset.id;
            const harga = parseInt(row.querySelector('.harga').textContent);
            const jumlah = parseInt(input.value);
            const total = harga * jumlah;
            row.querySelector('.total-item').textContent = total;
            hitungTotalSeluruhnya();

            fetch('ubah_jumlah_keranjang.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${idKeranjang}&jumlah=${jumlah}`
            });
        }

        function hapusItem(button) {
            const row = button.closest('tr');
            const idKeranjang = row.dataset.id;
            fetch('hapus_keranjang.php?id=' + idKeranjang)
                .then(() => row.remove())
                .then(() => hitungTotalSeluruhnya());
        }

        function hitungTotalSeluruhnya() {
            const totalItems = document.querySelectorAll('.total-item');
            let total = 0;
            totalItems.forEach(item => total += parseInt(item.textContent));
            document.querySelector('.total').textContent = `Total Belanja: Rp ${total.toLocaleString("id-ID")}`;
        }

        function ambilDataCheckout() {
            const rows = document.querySelectorAll('tbody tr');
            let data = [];
            rows.forEach(row => {
                const checkbox = row.querySelector('.pilih-produk');
                if (checkbox.checked) {
                    const id = row.dataset.id;
                    const jumlah = row.querySelector('.jumlah').value;
                    data.push({
                        id_keranjang: id,
                        jumlah: jumlah
                    });
                }
            });
            document.getElementById('produk_data').value = JSON.stringify(data);
            return data.length > 0;
        }

        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            if (!ambilDataCheckout()) {
                alert('Silakan pilih produk terlebih dahulu.');
                e.preventDefault();
            }
        });

        window.onload = hitungTotalSeluruhnya;
    </script>
</body>

</html>
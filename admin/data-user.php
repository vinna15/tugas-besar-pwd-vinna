<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Mecil Pets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn-edit,
        .btn-hapus {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-hapus {
            background-color: #dc3545;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-hapus:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <?php
    require 'header.php';
    ?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-box">
            <h2>Data User</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>U001</td>
                        <td>Andi Saputra</td>
                        <td>andi@example.com</td>
                        <td>081234567890</td>
                        <td>Aktif</td>
                        <td>
                            <button class="btn-edit"><i class="fas fa-user-edit"></i> Edit</button>
                            <button class="btn-hapus"><i class="fas fa-user-slash"></i> Hapus</button>
                        </td>
                    </tr>
                    <!-- Tambah baris produk lainnya di sini -->
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
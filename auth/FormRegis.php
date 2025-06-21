<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar - MecilPets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* height: 100vh; */
        }

        .register-container {
            margin: 10px 0px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 20px 0px;
        }

        .logo img {
            width: 60px;
            color: #d5f5e3;
        }

        .logo-text {
            display: flex;
            flex-direction: row;
            line-height: 1;
        }

        .logo-text .mecil {
            color: darkgray;
            font-weight: bold;
            font-size: 40px;
            margin: 0;
        }

        .logo-text .pets {
            color: #FFD700;
            /* kuning keemasan */
            font-weight: bold;
            font-size: 35px;
            margin: 0;
        }

        .register-container h4 {
            text-align: center;
            margin-bottom: 30px;
            color: #2E8B57;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #246B45;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            text-decoration: none;
            color: #2E8B57;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
     <div class="logo">
            <img src="../fotoEdit/paws.png" alt="Logo Paws" />
            <div class="logo-text">
                <p class="mecil">Mecil</p>
                <p class="pets">Pets</p>
            </div>
        </div>
    <div class="register-container">
        <h4><i class="fa-solid fa-user-plus"></i> Daftar Akun</h4>
        <form action="proses_register.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required />
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="tel" id="no_hp" name="no_hp" pattern="[0-9]{10,15}" placeholder="08xxxxxxxxxx" required />
            </div>

            <button type="submit">Daftar</button>
        </form>
        <div class="login-link">
            Sudah punya akun? <a href="LoginForm.php">Masuk di sini</a>
        </div>
    </div>
</body>

</html>

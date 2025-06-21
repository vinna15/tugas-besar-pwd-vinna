<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Login - MecilPets</title>
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
            height: 100vh;
        }

        .login-container {
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
            margin-bottom: 30px;
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


        .login-container h4 {
            text-align: center;
            margin-bottom: 20px;
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

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
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

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            text-decoration: none;
            color: #2E8B57;
        }

        .register-link a:hover {
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
    <div class="login-container">
        
        <h4><i class="fa-solid fa-right-to-bracket"></i> Login</h4>
        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>

            <button type="submit">Masuk</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="FormRegis.php">Daftar di sini</a>
        </div>
    </div>
</body>

</html>
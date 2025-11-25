<?php
session_start();


// si está logueado comoa admin, lo mandamos al panel
if (isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Panel Admin</title>
    <style>
        body {
            background-color: #f2f2f2;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background-color: white;
            width: 350px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 0px 10px #ccc;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 14px;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            background-color: #0A5BF1;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #0846b5;
        }

        .error-msg {
            background-color: #ffdddd;
            color: #a10000;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: left;
            border: 1px solid #a10000;
        }
    </style>
</head>

<body>

    <div class="login-box">

        <h2>Panel de Administración</h2>

        <!-- Mostrar errores si existen -->
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="error-msg">
                <?= $_SESSION['login_error']; ?>
            </div>
            <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>

        <form action="/Proyecto/vsgame/index.php?controller=user&action=login" method="POST">

            <div class="form-group">
                Email:
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                Contraseña:
                <input type="password" name="password" required>
            </div>

            <button class="btn-login" type="submit">Entrar</button>
        </form>

    </div>

</body>
</html>
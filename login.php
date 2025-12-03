<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: show.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/app.js"></script>
    <title>Inicio Sesión</title>
</head>
<body>
    <div class="form-container">
        <div id="logo">
            <img src="assets/images/logo.png" class="logo" alt="logo">
        </div>
        <div id="formularios">
            <form id="loginForm">
                <h2>Inicia sesión</h2>

                <input type="email" name="email" placeholder="Email"><br><br>

                <input type="password" name="password" placeholder="Contraseña"><br><br>
                <button type="submit" class="btn-form">Entrar</button>

                <p class="toggle">¿No tienes cuenta?
                    <a href="" id="showRegister">Regístrate</a>
                </p>
            </form>

            <form id="registerForm">
                <h2>Crea una cuenta</h2>
                <input type="email" name="email" placeholder="Email"><br><br>

                <input type="text" name="nickname" placeholder="Nombre de usuario"><br><br>

                <input type="password" name="password" placeholder="Contraseña"><br><br>
                <input type="password" name="confirmPass" placeholder="Repite Contraseña"><br><br>
                <button type="submit" class="btn-form">Registrarme</button>

                <p class="toggle">¿Ya tienes cuenta?
                    <a href="" id="showLogin">Inicia sesión</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
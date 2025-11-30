<?php 
// Si hay ya una sesión iniciada no la vuelves a iniciar
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Importamos la constante BASE_URL (muy importante)
require_once __DIR__ . '/views/config/config.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .navbar {
            background: #0A5BF1;
            color: white;
            padding: 15px;
            font-size: 19px;
        }

        .navbar a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <strong>Panel Admin | VSGame</strong>

        <?php if (isset($_SESSION['admin'])): ?>
            &nbsp; | &nbsp;
            <a href="index.php">Inicio</a>
            <a href="index.php?controller=user&action=list">Usuarios</a>
            <a href="index.php?controller=card&action=list">Cartas</a>
            <a href="index.php?controller=user&action=logout" style="float:right;">Cerrar sesión</a>
        <?php endif; ?>
    </div>

    <div class="content">
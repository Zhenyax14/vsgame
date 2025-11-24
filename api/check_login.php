<?php
header('Content-Type: application/json');
session_start();

// Respuesta si NO hay sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "logged" => false,
        "message" => "Error: No hay usuarios logueados"
    ]);
    exit;
}

// Si hay sesión activa, devuelve info de user
echo json_encode([
    "logged" => true,
    "user" => [
        "id" => $_SESSION['user_id'],
        "nickname" => $_SESSION['nickname'],
        "email" => $_SESSION['email']
    ]
]);

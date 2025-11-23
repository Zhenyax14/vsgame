<?php
header("Content-Type: application/json");
session_start();

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido"
    ]);
    exit;
}

require_once "../models/User.php";

// Recibir datos del FE
$email    = trim($_POST['email']) ?? null;
$password = trim($_POST['password']) ?? null;

// Validación de datos
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Faltan campos obligatorios."
    ]);
    exit;
}

$user = new User();
$datosUser = $user->getByEmail($email);

// Login incorrecto
if (!$datosUser) {
    echo json_encode([
        "success" => false,
        "message" => "Email no registrado."
    ]);
    exit;
}

// Validación contraseña
if (!password_verify($password, $datosUser['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Contraseña incorrecta."
    ]);
    exit;
}

// Login correcto? guardamos sesión
$_SESSION['user'] = [
    "id" => $datosUser['id'],
    "email" => $datosUser['nickname'],
    "nickname" => $datosUser['email']
];

// Respuesta 
echo json_encode([
    "success" => true,
    "message" => "Inicio de sesión correcto.",
    "user" => [
        "id" => $datosUser['id'],
        "nickname" => $datosUser['nickname'],
        "email" => $datosUser['email']
    ]
]);
exit;

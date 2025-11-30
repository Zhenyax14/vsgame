<?php
header('Content-Type: application/json');
session_start();

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido"
    ]);
    exit;
}

// Incluir el modelo User
require_once __DIR__ . '/../admin/models/User.php';


// Recibir datos del FE
$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data["email"] ?? "");
$nickname = trim($data["nickname"] ?? "");
$password = trim($data["password"] ?? "");

// Validación de entrada
if (!$nickname || !$email || !$password) {
    echo json_encode([
        "success" => false,
        "message" => "Todos los campos son obligatorios."
    ]);
    exit;
}

$user = new User();

// Validación email único
if ($user->getByEmail($email)) {
    echo json_encode([
        "success" => false,
        "message" => "Email ya registrado."
    ]);
    exit;
}

// Crear usuario
$result = $user->create($nickname, $email, $password);

// Respuesta al FE
echo json_encode([
    "success" => $result,
    "message" => $result ? "Usuario creado con éxito" : "Error al crear usuario"
]);
exit;
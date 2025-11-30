<?php
ini_set('session.cookie_path', '/Proyecto/vsgame/');
session_start();

header('Content-Type: application/json');

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido"
    ]);
    exit;
}

require_once __DIR__ . '/../admin/models/Game.php';

// Recibir datos del FE
$data = json_decode(file_get_contents("php://input"), true);

$usuarioId  = $_SESSION['user_id'] ?? null;
$puntuacion = $data['score'] ?? null;
$resultado  = $data['result'] ?? null;


if (!$usuarioId || $puntuacion === null || !$resultado) {
    echo json_encode([
        "success" => false,
        "message" => "Datos incompletos"
    ]);
    exit;
}

// Convertimos win/lose al enum MySQL
if ($resultado === "win")  $resultado = "victoria";
if ($resultado === "lose") $resultado = "derrota";

$game = new Game();
$ok = $game->save($usuarioId, $puntuacion, $resultado);

echo json_encode([
    "success" => $ok,
    "message" => $ok ? "Partida guardada correctamente" : "Error al guardar partida"
]);
exit;

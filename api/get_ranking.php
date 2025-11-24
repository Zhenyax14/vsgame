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

require_once "../models/User.php";

// instancia usuario
$user = new User();
$ranking = $user->getRanking();

echo json_encode([
    "success" => true,
    "ranking" => $ranking
]);

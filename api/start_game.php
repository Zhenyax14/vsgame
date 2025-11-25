<?php
header('Content-Type: application/json');
session_start();

require_once __DIR__ . '/../admin/models/Card.php';

try {
    $cardModel = new Card();

    // 1. Obtener todas las cartas
    $cartas = $cardModel->getAll();

    if (!$cartas || count($cartas) == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "No hay cartas en la base de datos."
        ]);
        exit;
    }

    // 2. Barajar el mazo
    shuffle($cartas);

    // 3. Devolver el mazo al FE
    echo json_encode([
        "status" => "ok",
        "mazo" => $cartas
    ]);

    } catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Error interno: " . $e->getMessage()
    ]);
}

<?php
header('Content-Type: application/json');

$scoresFile = 'scores.json';

// Obtener datos enviados en JSON
$input = json_decode(file_get_contents('php://input'), true);

// Validación
if (!isset($input['user']) || !isset($input['score'])) {
    echo json_encode([
        "success" => false,
        "message" => "Datos incompletos"
    ]);
    exit;
}

$entry = [
    'user'  => $input['user'],
    'score' => (int)$input['score']
];

// Leer el archivo de scores si existe (si no existe se crea)
$data = [];

if (file_exists($scoresFile)) {
    $decoded = json_decode(file_get_contents($scoresFile), true);
    if (is_array($decoded)) {
        $data = $decoded;
    }
}

// Añadir la nueva entrada
$data[] = $entry;

// Guardar el archivo
$success = file_put_contents($scoresFile, json_encode($data));

if ($success === false) {
    echo json_encode([
        "success" => false,
        "message" => "No se pudo guardar la puntuación"
    ]);
    exit;
}

echo json_encode([
    "success" => true,
    "message" => "Puntuación guardada"
]);




<?php
header("Content-Type: application/json");
session_start();

unset($_SESSION['user']);
session_destroy();

// Respuesta al FE
echo json_encode([
    "success" => true,
    "message" => "Sesión cerrada correctamente."
]);
exit;

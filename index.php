<?php

// Configura controlador y acción por defecto
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'controllerdefecto';
$action = isset($_GET['action']) ? $_GET['action'] : 'actiondefecto';

// Construye el nombre del archivo y de la clase del controlador
$controllerFile = "admin/controllers/" . ucfirst($controller) . "Controller.php";
$controllerClass = ucfirst($controller) . "Controller";

// Verifica si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Verifica si la clase del controlador existe
    if (class_exists($controllerClass)) {
        $controllerObject = new $controllerClass();

        // Verifica si la acción existe
        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            echo "Error: Acción '$action' no encontrada en el controlador '$controllerClass'.";
        }
    } else {
        echo "Error: Clase de controlador '$controllerClass' no encontrada.";
    }
} else {
    echo "Error: Archivo de controlador '$controllerFile' no encontrado.";
}

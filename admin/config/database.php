<?php
class Conexion
{
    // Guarda la única instancia de PDO
    private static $conexion = null;

    // para que no se pueda instanciar ni clonar
    private function __construct() {}
    private function __clone() {}

    public static function obtenerConexion()
    {
        if (self::$conexion === null) {
            $host = 'localhost';
            $db   = 'vsgame';
            $user = 'root';
            $pass = '';

            try {
                self::$conexion = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }
}

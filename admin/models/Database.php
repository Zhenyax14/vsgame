<?php 
include __DIR__ . '/../config/database.php';

class Database {
    protected $conex;

    public function __construct() {
        $this->conex = $this->connect();
    }
    // llamamos al método de Conexion
    public function connect() {
        return Conexion::obtenerConexion();
    }
}
    
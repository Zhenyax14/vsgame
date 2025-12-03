<?php 
include 'Database.php';

class Card extends Database{
    public function getAll() {
        $sql = "SELECT * FROM cartas";
        $stmt = $this->conex->query($sql);
        // devolvemos un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM cartas WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $ataque, $defensa, $poder, $tipo, $imagen = null, $descripcion = null) {
        $sql = "INSERT INTO cartas (nombre, ataque, defensa, imagen, poder, tipo)
        VALUES (:nombre, :ataque, :defensa, :imagen, :poder, :tipo)";
        // preparamos la consulta y vinculamos parámetros
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':ataque', $ataque);
        $stmt->bindValue(':defensa', $defensa);
        $stmt->bindValue(':imagen', $imagen);
        $stmt->bindValue(':poder', $poder);
        $stmt->bindValue(':tipo', $tipo);

        // ejecutamos y devolvemos resultado
        return $stmt->execute();
    }

    public function update($id, $nombre, $ataque, $defensa, $poder, $tipo, $imagen = null, $descripcion = null) {
        $sql = "UPDATE cartas SET nombre = :nombre, ataque = :ataque, defensa = :defensa, poder = :poder, tipo = :tipo, imagen = :imagen, descripcion = :descripcion
        WHERE id = :id";

        $stmt = $this->conex->prepare($sql);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':ataque', $ataque);
        $stmt->bindValue(':defensa', $defensa);
        $stmt->bindValue(':imagen', $imagen);
        $stmt->bindValue(':poder', $poder);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':descripcion', $descripcion);


        return $stmt->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM cartas WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
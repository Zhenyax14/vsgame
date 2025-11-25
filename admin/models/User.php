<?php 
include 'Database.php';

class User extends Database{
    // método para crear usuario
    public function create($nickname, $email, $password) {
        // contraseña "hasheada"
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // consulta sql para insertar
        $sql = "INSERT INTO usuarios (nickname, email, password)
        VALUES (:nickname, :email, :password)";
        // preparamos la consulta y vinculamos parámetros
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':nickname', $nickname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $hash);
        // ejecutamos y devolvemos resultado
        return $stmt->execute();
    }

    // método para llamar usuario por su email
    public function getByEmail($email) {
        // consulta para filtrar usuario por email
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        // devolvemos la fila como un array asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // método para actualizar score en bd
    public function updateScore($id, $newScore) {
        $sql = "UPDATE usuarios SET score = :score WHERE id = :id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':score', $newScore);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    // método para obtener el ranking
    public function getRanking() {
        $sql = "SELECT nickname, score FROM usuarios ORDER BY score DESC";
        $stmt = $this->conex->query($sql);
        // devolvemos un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // método para obtener a todos los usuarios ordenados
    public function getAll() {
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        $stmt = $this->conex->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // método para obtener usuario por id
    public function getById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // método para modificar usuario
    public function updateUser($id, $nickname, $email, $admin) {
        $sql = "UPDATE usuarios 
                SET nickname = :nickname, email = :email, admin = :admin
                WHERE id = :id";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':nickname', $nickname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':admin', $admin);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    // método para eliminar usuario
    public function delete($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }
}
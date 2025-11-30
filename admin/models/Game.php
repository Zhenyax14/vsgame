<?php
include 'Database.php';

class Game extends Database
{
    // método para guardar resultado
    public function save($usuarioId, $puntuacion, $resultado)
    {
        // consulta sql para insertar
        $sql = "INSERT INTO partidas (usuario_id, puntuacion, resultado)
                VALUES (:usuario_id, :puntuacion, :resultado)";
        // se prepara conexión y se vinculan parámetros
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':usuario_id', $usuarioId);
        $stmt->bindValue(':puntuacion', $puntuacion);
        $stmt->bindValue(':resultado', $resultado);
        // se devuelve resultado de la ejecución de la consulta
        $stmt->execute();
    }
    // método para obtener lar partidas de un usuario
    public function getUserGames($userId)
    {
        $sql = "SELECT * FROM games 
                WHERE user_id = :user_id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':user_id', $userId);

        $stmt->execute();
        // se devuelve array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // método para ver los stats de un usuario (partidas totales, partidas ganadas y perdidas)
    public function getUserStats($userId)
    {
        $sql = "SELECT 
                    COUNT(*) AS total_partidas,
                    SUM(resultado = 'victoria') AS victorias,
                    SUM(resultado = 'derrota') AS derrotas,
                    SUM(duracion_seg) AS tiempo_total
                FROM partidas
                WHERE usuario_id = :user_id";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

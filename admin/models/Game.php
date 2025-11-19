<?php
include 'Database.php';

class Game extends Database
{
    // método para guardar resultado
    public function save($userId, $score, $result)
    {
        // consulta sql para insertar
        $sql = "INSERT INTO games (user_id, score, result)
                VALUES (:user_id, :score, :result)";
        // se prepara conexión y se vinculan parámetros
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':score', $score);
        $stmt->bindValue(':result', $result);
        // se devuelve resultado de la ejecución de la consulta
        return $stmt->execute();
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
                    COUNT(*) AS total_games,
                    SUM(score) AS total_score,
                    SUM(result = 'win') AS wins,
                    SUM(result = 'lose') AS losses
                FROM games
                WHERE user_id = :user_id";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

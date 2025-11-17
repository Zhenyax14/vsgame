<?php
include 'Database.php';

class Game extends Database
{
    public function save($userId, $score, $result)
    {
        $sql = "INSERT INTO games (user_id, score, result)
                VALUES (:user_id, :score, :result)";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':score', $score);
        $stmt->bindValue(':result', $result);

        return $stmt->execute();
    }

    public function getUserGames($userId)
    {
        $sql = "SELECT * FROM games 
                WHERE user_id = :user_id";
        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':user_id', $userId);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserStats($userId)
    {
        $sql = "SELECT 
                    COUNT(*) AS total_games,
                    SUM(score) AS total_score,
                    SUM(result = 'win') AS wins,
                    SUM(result = 'lose') AS losses,
                    SUM(result = 'draw') AS draws
                FROM games
                WHERE user_id = :user_id";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

<?php 
require_once __DIR__ . '/../config/db.php';

class EventType
{
    public static function getAllActive()
    {
        global $pdo;

        $sql = "SELECT id, label 
                FROM event_type 
                WHERE status = 1 
                ORDER BY label ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
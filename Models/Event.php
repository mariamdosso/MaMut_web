<?php

require_once __DIR__ . '/../config/db.php';

class Event
{
    // Récupérer les infos d'un événement par ID
    public static function getById($eventId)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM event WHERE id = :id");
        $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

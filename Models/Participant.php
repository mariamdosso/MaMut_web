<?php

require_once __DIR__ . '/../config/db.php';

class Participant
{
    // Tous les participants
    public static function all()
    {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM user_event");
        return $stmt->fetchAll();
    }



    // Nouvelle méthode pour récupérer les participants par événement
    public static function getByEvent($eventId)
    {
        global $pdo;

        $stmt = $pdo->prepare("
        SELECT 
            u.id AS user_id,
            a.full_name AS user_name,
            a.email AS user_email,
            a.call_number AS user_phone,
            a.city AS user_city,
            a.gender AS user_gender,
            a.address AS user_address,
            e.id AS event_id,
            e.label AS event_label,
            e.event_ref,
            e.event_start_date,
            e.event_end_date
        FROM user_event ue
        JOIN user u ON ue.user_id = u.id
        JOIN adherent a ON u.adherent_id = a.id
        JOIN event e ON ue.event_id = e.id
        WHERE ue.event_id = :eventId
       ");
        $stmt->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

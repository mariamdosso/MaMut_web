<?php

require_once __DIR__ . '/../config/db.php';

class Participant
{

    public static function all()
    {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM user_event");
        return $stmt->fetchAll();
    }


    public static function getByEvent($eventId, $page = 1, $perPage = 6)
    {
        global $pdo;

        $offset = ($page - 1) * $perPage;

        $stmt = $pdo->prepare("
            SELECT 
                ue.id AS participant_id,
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
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Total
        $countStmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM user_event 
            WHERE event_id = :eventId
        ");
        $countStmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $countStmt->execute();
        $total = $countStmt->fetchColumn();

        return [
            "data" => $data,
            "total" => $total,
            "page" => $page,
            "perPage" => $perPage,
            "totalPages" => ceil($total / $perPage)
        ];
    }


    public static function addToEvent($eventId, $userId)
    {
        global $pdo;

        $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM user_event 
        WHERE user_id = :userId AND event_id = :eventId
    ");
        $stmt->execute([
            ':userId' => $userId,
            ':eventId' => $eventId
        ]);


        if ($stmt->fetchColumn() > 0) {
            return false;
        }

        $stmt = $pdo->prepare("
        INSERT INTO user_event (event_id, user_id, created_at, updated_at)
        VALUES (:eventId, :userId, NOW(), NOW())
    ");

        return $stmt->execute([
            ':eventId' => $eventId,
            ':userId' => $userId
        ]);
    }


    public static function delete($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM user_event WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getDetails($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("
        SELECT 
            ue.id AS participant_id,
            u.id AS user_id,
            a.full_name,
            a.email,
            a.call_number,
            a.city,
            a.gender,
            a.address,
            e.id AS event_id,
            e.label AS event_label,
            e.event_ref,
            e.event_start_date,
            e.event_end_date,
            ue.created_at,
            ue.updated_at
        FROM user_event ue
        JOIN user u ON ue.user_id = u.id
        JOIN adherent a ON u.adherent_id = a.id
        JOIN event e ON ue.event_id = e.id
        WHERE ue.id = :id
    ");

        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

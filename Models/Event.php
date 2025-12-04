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

    // Récupérer tous les événements
    public static function allEvent($page = 1, $perPage = 8)
    {
        global $pdo;

        $offset = ($page - 1) * $perPage;

        // Récupération des événements
        $sql = "SELECT * FROM event ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nombre total d'événements
        $totalStmt = $pdo->query("SELECT COUNT(*) as total FROM event");
        $totalEvents = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($totalEvents / $perPage);

        // Retourner les données + pagination
        return [
            "data" => $events,
            "total" => $totalEvents,
            "page" => $page,
            "perPage" => $perPage,
            "totalPages" => $totalPages
        ];
    }

    // Ajouter un événement
    public static function create(array $data)
    {
        global $pdo;

        $event_ref = "EVT_" . strtoupper(bin2hex(random_bytes(4)));
        $today = date("Y-m-d");

        $sql = "INSERT INTO event
            (label, event_ref, description, event_start_date, event_end_date, event_amount, with_participation, event_target_participation, event_type_id, statut_event_id, created_at, updated_at)
            VALUES
            (:label, :event_ref, :description, :start, :end, :amount, :participation, :target, :type, :statut, :created, :updated)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':label' => htmlspecialchars($data['label']),
            ':event_ref' => $event_ref,
            ':description' => htmlspecialchars($data['description'] ?? ''),
            ':start' => $data['event_start_date'],
            ':end' => $data['event_end_date'],
            ':amount' => floatval($data['event_amount']),
            ':participation' => intval($data['with_participation']),
            ':target' => floatval($data['event_target_participation']),
            ':type' => intval($data['event_type_id']),
            ':statut' => $data['statut_event_id'] ?? 2,
            ':created' => $today,
            ':updated' => $today
        ]);
    }

     public static function update(int $id, array $data)
    {
        global $pdo;

        $sql = "UPDATE event SET 
                    label = :label, 
                    event_amount = :amount, 
                    event_target_participation = :target,
                    event_start_date = :start, 
                    event_end_date = :end, 
                    with_participation = :participation,
                    event_type_id = :type, 
                    description = :description,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':label' => htmlspecialchars($data['label']),
            ':amount' => floatval($data['event_amount']),
            ':target' => floatval($data['event_target_participation']),
            ':start' => $data['event_start_date'],
            ':end' => $data['event_end_date'],
            ':participation' => intval($data['with_participation']),
            ':type' => intval($data['event_type_id']),
            ':description' => htmlspecialchars($data['description'] ?? ''),
            ':id' => $id
        ]);
    }
}

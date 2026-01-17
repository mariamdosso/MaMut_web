<?php

require_once __DIR__ . '/../config/db.php';

class Event
{

    public static function getById($eventId)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM event WHERE id = :id");
        $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function allEvent($page = 1, $perPage = 8)
    {
        global $pdo;

        $offset = ($page - 1) * $perPage;

        $sql = "SELECT * FROM event ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalStmt = $pdo->query("SELECT COUNT(*) as total FROM event");
        $totalEvents = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($totalEvents / $perPage);

        return [
            "data" => $events,
            "total" => $totalEvents,
            "page" => $page,
            "perPage" => $perPage,
            "totalPages" => $totalPages
        ];
    }

   public static function create(array $data)
    {
        global $pdo;

        $event_ref = "EVT_" . strtoupper(bin2hex(random_bytes(4)));
        $today = date("Y-m-d");

        $sql = "INSERT INTO event (
                    label,
                    event_ref,
                    description,
                    event_start_date,
                    event_end_date,
                    with_participation,
                    contribution_type,
                    event_amount,
                    event_target_participation,
                    event_type_id,
                    statut_event_id,
                    created_at,
                    updated_at
                ) VALUES (
                    :label,
                    :event_ref,
                    :description,
                    :start,
                    :end,
                    :participation,
                    :contribution_type,
                    :amount,
                    :target,
                    :type,
                    1,
                    :created,
                    :updated
                )";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':label' => htmlspecialchars($data['label']),
            ':event_ref' => $event_ref,
            ':description' => htmlspecialchars($data['description'] ?? ''),
            ':start' => $data['event_start_date'],
            ':end' => $data['event_end_date'],
            ':participation' => intval($data['with_participation']),
            ':contribution_type' => $data['contribution_type'],
            ':amount' => $data['event_amount'], 
            ':target' => $data['event_target_participation'], 
            ':type' => intval($data['event_type_id']),
            ':created' => $today,
            ':updated' => $today
        ]);
    }

    public static function update(int $id, array $data)
    {
        global $pdo;

        $sql = "UPDATE event SET 
                    label = :label,
                    description = :description,
                    event_start_date = :start,
                    event_end_date = :end,
                    with_participation = :participation,
                    contribution_type = :contribution_type,
                    event_amount = :amount,
                    event_target_participation = :target,
                    event_type_id = :type,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':label' => htmlspecialchars($data['label']),
            ':description' => htmlspecialchars($data['description'] ?? ''),
            ':start' => $data['event_start_date'],
            ':end' => $data['event_end_date'],
            ':participation' => intval($data['with_participation']),
            ':contribution_type' => $data['contribution_type'],
            ':amount' => $data['event_amount'], // NULL ou valeur
            ':target' => $data['event_target_participation'], // NULL ou valeur
            ':type' => intval($data['event_type_id']),
            ':id' => $id
        ]);
    }
}

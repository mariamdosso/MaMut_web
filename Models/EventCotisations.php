<?php
require_once __DIR__ . '/../config/db.php';

class EventCotisations
{
   /**
     * Vérifier si un event a déjà une caisse
     */
   public static function getByEvent(int $eventId)
{
    global $pdo;

    $sql = "
        SELECT 
            ec.id,
            ec.event_id,
            ec.fund_id,
            ec.created_at AS attached_at,

            f.code AS fund_code,
            f.label AS fund_label,
            f.balance,
            f.created_at AS fund_created_at,

            fs.label AS status_label,
            fs.code AS status_code
        FROM event_cotisations ec
        INNER JOIN fund f ON f.id = ec.fund_id
        INNER JOIN fund_status fs ON fs.id = f.fund_status_id
        WHERE ec.event_id = :event_id
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':event_id' => $eventId]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    /**
     * Attacher une caisse à un event
     */
    public static function attachFund(int $eventId, int $fundId): bool
    {
        global $pdo;

        // Sécurité : vérifier si l'event a déjà une caisse
        $check = $pdo->prepare("
            SELECT COUNT(*) 
            FROM event_cotisations 
            WHERE event_id = :event_id
        ");
        $check->execute([':event_id' => $eventId]);

        if ($check->fetchColumn() > 0) {
            return false; // déjà attaché
        }

        $stmt = $pdo->prepare("INSERT INTO event_cotisations (event_id, fund_id, created_at, updated_at) VALUES (
                :event_id, :fund_id, NOW(), NOW()
            )
        ");

        return $stmt->execute([
            ':event_id' => $eventId,
            ':fund_id'  => $fundId
        ]);
    }
}
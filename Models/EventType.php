<?php 
require_once __DIR__ . '/../config/db.php';

class EventType
{
    // Récupère tous les types actifs
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

    // Récupère tous les types (actifs et inactifs) avec pagination
    public static function getAllPaginated($limit, $offset)
    {
        global $pdo;

        $sql = "SELECT * 
                FROM event_type 
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Compte le nombre total de types
    public static function countAll()
    {
        global $pdo;

        $stmt = $pdo->query("SELECT COUNT(*) FROM event_type");
        return (int) $stmt->fetchColumn();
    }

    // Récupère le dernier ID pour générer le code
    private static function generateCode()
    {
        global $pdo;

        $sql = "SELECT MAX(id) as max_id FROM event_type";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nextId = $row['max_id'] + 1;

        // Format ENV_00001
        return "ENV_" . str_pad($nextId, 5, '0', STR_PAD_LEFT);
    }

    // Crée un nouveau type d'événement
    public static function create($label)
    {
        global $pdo;

        $code = self::generateCode();
        $status = 1; // statut par défaut actif

        $sql = "INSERT INTO event_type (label, code, status, created_at, updated_at)
                VALUES (:label, :code, :status, NOW(), NOW())";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':label' => $label,
            ':code' => $code,
            ':status' => $status
        ]);
    }

    // Met à jour un type d'événement
    public static function update($id, $label, $code, $status)
    {
        global $pdo;

        $sql = "UPDATE event_type
                SET label = :label, code = :code, status = :status, updated_at = NOW()
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':label' => $label,
            ':code' => $code,
            ':status' => $status
        ]);
    }

    // Récupère un type par ID
    public static function getById($id)
    {
        global $pdo;

        $sql = "SELECT * FROM event_type WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Désactive un type d'événement (status = 0)
    public static function deactivate($id)
    {
        global $pdo;

        $sql = "UPDATE event_type 
                SET status = 0, updated_at = NOW() 
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Active un type d'événement (status = 1)
    public static function activate($id)
    {
        global $pdo;

        $sql = "UPDATE event_type 
                SET status = 1, updated_at = NOW() 
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
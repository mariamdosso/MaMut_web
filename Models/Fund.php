<?php
require_once __DIR__ . '/../config/db.php';

class Fund
{
    /**
     * Create a new fund
     */
   public static function create(array $data)
    {
        global $pdo;

        // Generate fund code automatically
        $code = self::generateUniqueCode($pdo);

        $sql = "INSERT INTO fund (
                    code,
                    label,
                    balance,
                    fund_status_id,
                    created_at,
                    updated_at
                ) VALUES (
                    :code,
                    :label,
                    :balance,
                    :fund_status_id,
                    NOW(),
                    NOW()
                )";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':code' => $code,
            ':label' => htmlspecialchars(trim($data['label'])),
            ':balance' => 0,
            ':fund_status_id' => 1 // default: OPEN
        ]);
    }

    // Generate fund code automatically
    private static function generateUniqueCode(PDO $pdo): string
    {
        do {
            $code = 'FUND_' . strtoupper(bin2hex(random_bytes(4)));
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM fund WHERE code = ?");
            $stmt->execute([$code]);
        } while ($stmt->fetchColumn() > 0);

        return $code;
    }

    /**
     * Get all funds
     */
    public static function getAll()
    {
        global $pdo;

        $sql = "SELECT f.*, fs.label AS status_label, fs.code AS status_code
                FROM fund f
                JOIN fund_status fs ON fs.id = f.fund_status_id
                ORDER BY f.created_at DESC";

        return $pdo->query($sql)->fetchAll();
    }

    /**
     * Count all funds
     */
    public static function countAll()
    {
        global $pdo;

        $stmt = $pdo->query("SELECT COUNT(*) FROM fund");
        return (int) $stmt->fetchColumn();
    }

    /**
     * Get paginated funds
     */
    public static function getAllPaginated(int $limit, int $offset)
    {
        global $pdo;

        $sql = "
            SELECT 
                f.*,
                fs.label AS status_label,
                fs.code AS status_code
            FROM fund f
            JOIN fund_status fs ON fs.id = f.fund_status_id
            ORDER BY f.created_at DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a fund by ID
     */
    public static function findById(int $id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT f.*, fs.label AS status_label, fs.code AS status_code
                               FROM fund f
                               JOIN fund_status fs ON fs.id = f.fund_status_id
                               WHERE f.id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Update the label of a fund
     */
    public static function updateLabel(int $id, string $label)
    {
        global $pdo;

        $stmt = $pdo->prepare("UPDATE fund SET label = :label, updated_at = NOW() WHERE id = :id");
        return $stmt->execute([
            ':label' => $label,
            ':id' => $id
        ]);
    }

    /**
     * Get the current status of a fund
     */
    public static function getStatus(int $id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT fs.* 
                               FROM fund f
                               JOIN fund_status fs ON fs.id = f.fund_status_id
                               WHERE f.id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Change the status of a fund
     */
    public static function changeStatus(int $id, int $fund_status_id)
    {
        global $pdo;

        $stmt = $pdo->prepare("UPDATE fund SET fund_status_id = :status_id, updated_at = NOW() WHERE id = :id");
        return $stmt->execute([
            ':status_id' => $fund_status_id,
            ':id' => $id
        ]);
    }

    
    /**
     * get All fund to attach on event
     */
    public static function getAttachableFunds()
    {
        global $pdo;

        $sql = "
            SELECT 
                f.id, 
                f.label, 
                f.balance
            FROM fund f
            JOIN fund_status fs ON fs.id = f.fund_status_id
            WHERE fs.code = 'OPEN'
            AND f.id NOT IN (
                SELECT fund_id FROM event_cotisations
            )
            ORDER BY f.label ASC
        ";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

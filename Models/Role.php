<?php
require_once __DIR__ . "/../config/db.php";

class Role
{
    public static function all()
    {
        global $pdo;
        
        $stmt = $pdo->query("SELECT * FROM roles");
        return $stmt->fetchAll();
    }

    public static function getUserRole($userId)
    {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT r.code AS role
            FROM user_role ur
            JOIN roles r ON r.id = ur.role_id
            WHERE ur.user_id = :user_id
              AND ur.status = 'active'
            LIMIT 1
        ");
        $stmt->execute([':user_id' => $userId]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        return $role['role'] ?? 'guest';
    }
}
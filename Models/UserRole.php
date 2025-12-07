<?php
require_once __DIR__ . '/../config/db.php';

class UserRole
{
    public static function assignRole(int $user_id, int $role_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("
            INSERT INTO user_role (user_id, role_id, status)
            VALUES (?, ?, 'active')
        ");
        return $stmt->execute([$user_id, $role_id]);
    }
}

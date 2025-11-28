<?php
require_once __DIR__ . '/../config/db.php';

class User
{
    public static function allUsers()
    {
        global $pdo;

        $stmt = $pdo->query("
            SELECT 
                u.id,
                a.full_name,
                a.email,
                a.call_number,
                a.city,
                a.gender,
                a.address
            FROM user u
            JOIN adherent a ON u.adherent_id = a.id
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

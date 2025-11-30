<?php

require_once __DIR__ . '/../config/db.php';

class Dashboard
{
    public static function getTotalMembers(): int
    {
        global $pdo;
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM adherent");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['total']);
    }

    public static function getTotalEvents(): int
    {
        global $pdo;
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM event");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['total']);
    }

    public static function getTotalFunds(): int
    {
        global $pdo;
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM fund");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['total']);
    }

    
}

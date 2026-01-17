<?php
require_once __DIR__ . '/../config/db.php';

class FundStatus
{
   public static function getAll()
    {
       global $pdo;

        try {
            $stmt = $pdo->query("SELECT * FROM fund_status ORDER BY id ASC");
            $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $statuses;
        } catch (PDOException $e) {
            error_log("Error fetching fund statuses: " . $e->getMessage());
            return [];
        }
    }
}

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
}
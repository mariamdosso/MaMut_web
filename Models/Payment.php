<?php
require_once __DIR__ . '/../config/db.php';

class Payment
{
    public static function all()
    {
        global $pdo;

        $stmt = $pdo->query("SELECT * FROM payment");
        return $stmt->fetchAll();
    }

    public static function getById($id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM payment WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
}
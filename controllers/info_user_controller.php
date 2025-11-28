<?php 

include("config/db.php");

if (!isset($_SESSION['user_info'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user_info']; 

$sql = "SELECT * FROM adherent WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $user['adherent_id'] ?? $user['id']]);
$adherent = $stmt->fetch(PDO::FETCH_ASSOC);

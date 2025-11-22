<?php
include("config/db.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Adhérent non spécifié.");
}

$adherent_id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM adherent WHERE id = ?");
$stmt->execute([$adherent_id]);
$adherent = $stmt->fetch();

if (!$adherent) {
    die("Adhérent introuvable.");
}


$roles_stmt = $pdo->query("SELECT * FROM roles");
$roles = $roles_stmt->fetchAll();


include("vews/create_user_account.php");

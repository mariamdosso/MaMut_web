<?php
include("config/db.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


if ($id <= 0) {
    die("ID invalide !");
}

$stmt = $pdo->prepare("
    SELECT 
        a.id AS adherent_id,
        a.full_name,
        a.birth_date,
        a.gender,
        a.city,
        a.date_of_joining,
        a.email,
        a.created_by,
        a.call_number,
        a.municipality_department,
        a.address,
        u.login AS created_by_login
    FROM adherent a
    LEFT JOIN user u ON u.id = a.created_by
    WHERE a.id = :id
    LIMIT 1
");
$stmt->execute(['id' => $id]);
$adherent = $stmt->fetch(PDO::FETCH_ASSOC);



if (!$adherent) {
    die("Adhérent non trouvé !");
}


include("views/edit_member.php");
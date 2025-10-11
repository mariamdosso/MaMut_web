<?php
$hello = "world";
include("config/db.php");

$perPage = 8; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;


$totalStmt = $pdo->query("SELECT COUNT(*) FROM adherent");
$totalAdherents = $totalStmt->fetchColumn();
$totalPages = ceil($totalAdherents / $perPage);


$sql = "
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
        
        u.id AS user_id,
        u.login AS created_by_login,
        ua.status AS user_status,
        ua.id AS has_account_id
    FROM adherent a
     LEFT JOIN user u ON u.id = a.created_by
     LEFT JOIN user ua ON ua.adherent_id = a.id 
     ORDER BY a.id DESC
    LIMIT :limit OFFSET :offset
";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$adherents = $stmt->fetchAll();

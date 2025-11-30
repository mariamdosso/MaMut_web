<?php
include("config/db.php");

$perPage = 8;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

$search = trim($_GET['search'] ?? '');

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
    WHERE a.full_name LIKE :search
       OR a.city LIKE :search
       OR a.gender LIKE :search
       OR a.email LIKE :search
    ORDER BY a.full_name ASC
    LIMIT :limit OFFSET :offset
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$adherents = $stmt->fetchAll(PDO::FETCH_ASSOC);

$countSql = "
    SELECT COUNT(*) 
    FROM adherent a
    WHERE a.full_name LIKE :search
       OR a.city LIKE :search
       OR a.gender LIKE :search
       OR a.email LIKE :search
";

$countStmt = $pdo->prepare($countSql);
$countStmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$countStmt->execute();
$totalAdherents = $countStmt->fetchColumn();
$totalPages = ceil($totalAdherents / $perPage);

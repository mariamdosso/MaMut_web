<?php
include(__DIR__ . '/../config/db.php');

$perPage = 8; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;


$sql = "SELECT * FROM event ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalStmt = $pdo->query("SELECT COUNT(*) as total FROM event");
$totalEvents = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalEvents / $perPage);


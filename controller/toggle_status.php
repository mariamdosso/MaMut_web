<?php
include("config/db.php");

if (isset($_GET['id'], $_GET['user_status'])) {
    $id = (int) $_GET['id'];
    $newStatus = $_GET['user_status'] === 'active' ? 'active' : 'inactive';

    $stmt = $pdo->prepare("UPDATE user SET status = :status WHERE id = :id");
    $stmt->execute([
        ':status' => $newStatus,
        ':id' => $id
    ]);
}

header('location://localhost/MaMut_web/member_list');
exit;
?>
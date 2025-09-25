<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); // optionnel : ne pas afficher les warnings dans le JSON
include("../config/db.php"); // chemin corrigé
header("Content-Type: application/json");

if(isset($_POST['event_id'])){
    $event_id = intval($_POST['event_id']);

    $stmt = $pdo->prepare("
        SELECT m.member_id, m.member_name
        FROM participation p
        JOIN member m ON p.member_id = m.member_id
        WHERE p.event_id = ?
    ");
    $stmt->execute([$event_id]);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($members);
}

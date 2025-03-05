<?php 
$hello = "world";
include("config/db.php");

$sql = "SELECT * FROM member";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $members = $stmt->fetchAll();
    // var_dump($members);
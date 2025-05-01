<?php 
$hello = "world";
include("config/db.php");

$sql = "SELECT * FROM event";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $events = $stmt->fetchAll();
    // var_dump($event);

    
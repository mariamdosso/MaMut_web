<?php  
    include("config/db.php");

    $queryMembers = $pdo->query("SELECT COUNT(*) as total FROM member");
    $members = $queryMembers->fetch(PDO::FETCH_ASSOC); 
    $queryevent = $pdo->query("SELECT COUNT(*) as total FROM event");
    $events = $queryevent->fetch(PDO::FETCH_ASSOC); 

    $querycaisse = $pdo->query("SELECT COUNT(*) as total FROM fund");
    $fund = $querycaisse->fetch(PDO::FETCH_ASSOC); 
?> 



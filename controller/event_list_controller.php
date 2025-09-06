<?php
include("config/db.php");

$sql = "SELECT * FROM event";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll();

foreach ($events as &$event) {
    $sqlParticipants = "SELECT m.member_name 
                        FROM participation p
                        INNER JOIN member m ON p.member_id = m.member_id
                        WHERE p.event_id = :event_id";
    $stmtParticipants = $pdo->prepare($sqlParticipants);
    $stmtParticipants->execute(["event_id" => $event['event_id']]);
    $event['participants'] = $stmtParticipants->fetchAll();
}
unset($event);

?>

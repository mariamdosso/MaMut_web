<?php 
require_once("config/db.php");

$sql = "
    SELECT 
        f.fund_id,
        f.fund_name,
        f.tatal_amount_fund,
        f.date_ceation_fund,
        COALESCE(SUM(p.amount), 0) AS total_participations
    FROM fund f
    LEFT JOIN event_fund ef ON f.fund_id = ef.id_fund
    LEFT JOIN event e ON ef.id_event = e.event_id
    LEFT JOIN participation p ON e.event_id = p.event_id
    GROUP BY f.fund_id
    ORDER BY f.fund_id DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$funds = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

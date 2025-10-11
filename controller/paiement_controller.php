<?php
include("../config/db.php");
session_start();
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id   = intval($_POST['event_id']);
    $member_id  = intval($_POST['member_id']);
    $amountPaid = floatval($_POST['amount_paid']);

    try {
        $stmt = $pdo->prepare("
    SELECT m.*
    FROM participation p
    JOIN members m ON p.member_id = m.member_id
    WHERE p.event_id = :event_id
");
$stmt->execute(["event_id" => $event_id]);
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if (!$participation) {
            throw new Exception("⚠️ Participation introuvable !");
        }

        if ($amountPaid <= 0) {
            throw new Exception("⚠️ Montant invalide.");
        }
        if ($amountPaid > $participation['balance']) {
            throw new Exception("⚠️ Le montant payé dépasse le reste dû.");
        }

        $pdo->beginTransaction();

        // Mise à jour participation
        $newPaid    = $participation['paid_amount'] + $amountPaid;
        $newBalance = $participation['amount_due'] - $newPaid;
        $newStatus  = $newBalance <= 0 ? "paid" : "partial";

        $update = $pdo->prepare("
            UPDATE participation 
            SET paid_amount = :paid, balance = :balance, status = :status 
            WHERE participation_id = :id
        ");
        $update->execute([
            "paid"    => $newPaid,
            "balance" => $newBalance,
            "status"  => $newStatus,
            "id"      => $participation['participation_id']
        ]);

        // Enregistrer le flux de trésorerie
        $insertFlow = $pdo->prepare("
            INSERT INTO cash_flow (fund_id, event_id, member_id, amount, flow_type, created_at)
            VALUES (:fund_id, :event_id, :member_id, :amount, 'in', NOW())
        ");
        $insertFlow->execute([
            "fund_id"   => 1, // TODO: relier à la bonne caisse
            "event_id"  => $event_id,
            "member_id" => $member_id,
            "amount"    => $amountPaid
        ]);

        // Mettre à jour la caisse
        $pdo->exec("UPDATE fund SET balance = balance + $amountPaid WHERE fund_id = 1");

        $pdo->commit();

        echo json_encode(["success" => true, "message" => "✅ Paiement enregistré avec succès !"]);

    } catch (Exception $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}

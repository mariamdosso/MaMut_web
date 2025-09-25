<?php
include("../config/db.php");
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_info']['user_id'])) {
    echo json_encode(['success' => false, 'message' => "Utilisateur non connecté."]);
    exit;
}

$user_id = $_SESSION['user_info']['user_id'];

if (
    !empty($_POST['libelle']) &&
    !empty($_POST['type']) &&
    !empty($_POST['domaine']) &&
    !empty($_POST['date_debut']) &&
    !empty($_POST['date_fin'])
) {
    $libelle      = htmlspecialchars($_POST['libelle']);
    $type         = htmlspecialchars($_POST['type']);
    $domaine      = htmlspecialchars($_POST['domaine']);
    $date_debut   = $_POST['date_debut'];
    $date_fin     = $_POST['date_fin'];
    $periodicite  = $_POST['periode'] ?? null;

    $participation = !empty($_POST['contribution_amount']) ? floatval($_POST['contribution_amount']) : 0;
    $sql = "INSERT INTO event (
                event_label, event_type, event_domain, 
                event_date_start, event_date_end, 
                event_periodicity, event_contribution_amount, 
                user_id
            )
            VALUES (
                :event_label, :event_type, :event_domain, 
                :event_date_start, :event_date_end, 
                :event_periodicity, :event_contribution_amount, 
                :user_id
            )";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        "event_label" => $libelle,
        "event_type" => $type,
        "event_domain" => $domaine,
        "event_date_start" => $date_debut,
        "event_date_end" => $date_fin,
        "event_periodicity" => $periodicite,
        "event_contribution_amount" => $participation,
        "user_id" => $user_id
    ]);

    if ($result) {
        $event_id = $pdo->lastInsertId();

        if (!empty($_POST['membres'])) {
            $membres = $_POST['membres'];
            $stmtParticipation = $pdo->prepare(
                "INSERT INTO participation 
                (event_id, member_id, added_date, label, amount, amount_due, paid_amount, balance, status) 
                VALUES 
                (:event_id, :member_id, :added_date, :label, :amount, :amount_due, :amount_paid, :balance, :status)"
            );

            $addDate = (new DateTime())->format("Y-m-d");
            foreach ($membres as $member_id) {
                $stmtParticipation->execute([
                    "event_id"   => $event_id,
                    "member_id"  => $member_id,
                    "added_date" => $addDate,
                    "label"      => "Participation du $addDate",
                    "amount"     => $participation,
                    "amount_due" => $participation,
                    "amount_paid"=> 0,
                    "balance"    => $participation ,
                    "status"     => "NON SOLDE",
                ]);
            }
        }

        echo json_encode(['success' => true, 'message' => "✅ Événement ajouté avec succès !"]);
    } else {
        echo json_encode(['success' => false, 'message' => "❌ Erreur lors de l'ajout de l'événement."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "⚠️ Veuillez remplir tous les champs obligatoires."]);
}

<?php
session_start();
include("../config/db.php");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cotisation = $_POST['cotisation'];

    if (!isset($_SESSION['user_info']['user_id'])) {
        $_SESSION['message'] = "Erreur : utilisateur non connecté.";
        header('Location: http://localhost/MaMut_web/login.php');
        exit;
    }

    $user_id = $_SESSION['user_info']['user_id'];

    if (
        isset($_POST['libelle'], $_POST['type'], $_POST['domaine'], $_POST['date_debut'], $_POST['date_fin'], $_POST['periode'], $_POST['participation'])
        && !empty($_POST['libelle']) && !empty($_POST['type']) && !empty($_POST['domaine'])
        && !empty($_POST['date_debut']) && !empty($_POST['date_fin']) && !empty($_POST['periode']) && !empty($_POST['participation'])
    ) {
        $libelle = htmlspecialchars($_POST['libelle']);
        $type = htmlspecialchars($_POST['type']);
        $domaine = htmlspecialchars($_POST['domaine']);
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        $periodicite = $_POST['periode'];
        $participation = $_POST['participation'];

        $sql = "INSERT INTO event (event_label, event_type, event_domain, event_date_start, event_date_end, event_periodicity, event_contribution_amount, user_id)
                VALUES (:event_label, :event_type, :event_domain, :event_date_start, :event_date_end, :event_periodicity, :event_contribution_amount, :user_id)";

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

            if ($cotisation === 'oui' && !empty($_POST['membres'])) {
                $membres = $_POST['membres'];

                $stmtParticipation = $pdo->prepare("INSERT INTO participation (event_id, member_id) VALUES (:event_id, :member_id)");

                foreach ($membres as $member_id) {
                    $stmtParticipation->execute([
                        "event_id" => $event_id,
                        "member_id" => $member_id,
                    ]);
                }
            }

            $_SESSION['message'] = "Événement et participations ajoutés avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de l'ajout de l'événement.";
        }

        header('Location: http://localhost/MaMut_web/add_event');
        exit;
    }
}
?>

<?php 
session_start();
include("../config/db.php");

// Vérification de connexion utilisateur
if (!isset($_SESSION['user_info']['user_id'])) {
    $_SESSION['message'] = "Erreur : utilisateur non connecté.";
    header('Location: http://localhost/MaMut_web/login.php');
    exit;
}

$user_id = $_SESSION['user_info']['user_id'];

// Vérification des champs obligatoires
if (
    isset($_POST['libelle'], $_POST['type'], $_POST['domaine'], $_POST['date_debut'], $_POST['date_fin'])
    && !empty($_POST['libelle']) && !empty($_POST['type']) && !empty($_POST['domaine'])
    && !empty($_POST['date_debut']) && !empty($_POST['date_fin'])
) {
    $libelle = htmlspecialchars($_POST['libelle']);
    $type = htmlspecialchars($_POST['type']);
    $domaine = htmlspecialchars($_POST['domaine']);
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $periodicite = !empty($_POST['periode']) ? $_POST['periode'] : null;

    // Participation facultative
    $has_participation = isset($_POST['has_participation']) ? 1 : 0;
    $participation = $has_participation ? (isset($_POST['participation']) ? $_POST['participation'] : 0) : 0;


    // 1. Insérer l'événement
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

        // 2. Si participation activée et membres sélectionnés
        if ($has_participation && !empty($_POST['membres'])) {
            $membres = $_POST['membres'];

            $stmtParticipation = $pdo->prepare("INSERT INTO participation (event_id, member_id, amount) VALUES (:event_id, :member_id, :amount)");

            foreach ($membres as $member_id) {
                $stmtParticipation->execute([
                    "event_id" => $event_id,
                    "member_id" => $member_id,
                    "amount" => $participation
                ]);
            }
        }

        $_SESSION['successMessage'] = "Événement ajouté avec succès.";
    } else {
        $_SESSION['errorMessage'] = "Erreur lors de l'ajout de l'événement.";
    }

    header('Location: http://localhost/MaMut_web/add_event');
    exit;
} else {
    $_SESSION['errorMessage'] = "Veuillez remplir tous les champs obligatoires.";
    header('Location: http://localhost/MaMut_web/add_event');
    exit;
}
?>

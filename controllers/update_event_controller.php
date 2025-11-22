<?php
include(__DIR__ . '/../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        die("ID de l'événement manquant ou invalide");
    }

    $event_id = (int)$_POST['id'];

    // Validation des champs obligatoires
    $requiredFields = ['label', 'event_amount', 'event_target_participation', 'event_start_date', 'event_end_date', 'with_participation', 'event_type_id'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === '') {
            die("Le champ '$field' est requis.");
        }
    }

    // Préparer les données
    $label = htmlspecialchars($_POST['label']);
    $event_amount = floatval($_POST['event_amount']);
    $event_target = floatval($_POST['event_target_participation']);
    $start_date = $_POST['event_start_date'];
    $end_date = $_POST['event_end_date'];
    $with_participation = intval($_POST['with_participation']);
    $event_type_id = intval($_POST['event_type_id']);
    $description = htmlspecialchars($_POST['description'] ?? '');

    // Mettre à jour l'événement
    $sql = "UPDATE event SET 
                label = :label, 
                event_amount = :amount, 
                event_target_participation = :target,
                event_start_date = :start, 
                event_end_date = :end, 
                with_participation = :participation,
                event_type_id = :type, 
                description = :description,
                updated_at = NOW()
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':label' => $label,
        ':amount' => $event_amount,
        ':target' => $event_target,
        ':start' => $start_date,
        ':end' => $end_date,
        ':participation' => $with_participation,
        ':type' => $event_type_id,
        ':description' => $description,
        ':id' => $event_id
    ]);

    if ($result) {
        // Redirection vers la liste avec message de succès
        $_SESSION['message'] = "✅ Événement mis à jour avec succès !";
        header('Location: /MaMut_web/event_list');
        exit;
    } else {
        die("❌ Erreur lors de la mise à jour de l'événement.");
    }
} else {
    die("Méthode non autorisée.");
}

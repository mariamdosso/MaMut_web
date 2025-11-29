<?php
include(__DIR__ . '/../config/db.php');


if (!isset($_SESSION['user_info']['id'])) {
    $_SESSION['errorMessage'] = "Vous devez être connecté pour ajouter évenement.";
    header('Location: /MaMut_web/login');
    exit();
}



if (
    !empty($_POST['label']) &&
    !empty($_POST['event_type_id']) &&
    !empty($_POST['event_start_date']) &&
    !empty($_POST['event_end_date']) &&
    isset($_POST['with_participation']) &&
    isset($_POST['event_amount']) &&
    isset($_POST['event_target_participation'])
) {

    $event_ref = "EVT_" . strtoupper(bin2hex(random_bytes(4)));

    $label = htmlspecialchars($_POST['label']);
    $description    = htmlspecialchars($_POST['description'] ?? '');
    $event_start    = $_POST['event_start_date'];
    $event_end      = $_POST['event_end_date'];
    $event_amount   = floatval($_POST['event_amount']);
    $target_amount  = floatval($_POST['event_target_participation']);
    $with_participation = intval($_POST['with_participation']); 
    $event_type_id  = intval($_POST['event_type_id']);

    $statut_event_id = 2;
    $today = date("Y-m-d");

    $sql = "INSERT INTO event
        (label, event_ref, description, event_start_date, event_end_date, event_amount, with_participation, event_target_participation, event_type_id, statut_event_id, created_at, updated_at)
        VALUES
        (:label, :event_ref, :description, :start, :end, :amount, :participation, :target, :type, :statut, :created, :updated)";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':label' => $label,
        ':event_ref' => $event_ref,
        ':description' => $description,
        ':start' => $event_start,
        ':end' => $event_end,
        ':amount' => $event_amount,
        ':participation' => $with_participation,
        ':target' => $target_amount,
        ':type' => $event_type_id,
        ':statut' => $statut_event_id,
        ':created' => $today,
        ':updated' => $today
    ]);

    var_dump($result);

    if ($result) {
        
        $_SESSION['message'] = "Événement ajouté avec succès !";
        header('location://localhost:8000/MaMut_web/event_list');
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => "Erreur lors de l'ajout de l'événement."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Veuillez remplir tous les champs obligatoires."]);
}

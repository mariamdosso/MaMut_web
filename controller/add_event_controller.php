<?php 
include("../config/db.php");
if (!$pdo) {
    die("Erreur de connexion à la base de données !");
}

$message = '';

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

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Erreur : utilisateur non connecté.";
        header('Location: http://localhost/MaMut_web/add_event');
        // exit();
    }
    
    $user_id = $_SESSION['user_id'];  

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
        $_SESSION['message'] = "Événement ajouté avec succès.";
        header('Location: http://localhost/MaMut_web/add_event');
        // exit();
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout de l'événement.";
        header('Location: http://localhost/MaMut_web/add_event');
        // exit();
    }
}
    $sql = "SELECT event.*, user.user_name, user.user_email 
        FROM event 
        INNER JOIN user ON event.user_id = user.id";

    $stmt = $pdo->query($sql);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
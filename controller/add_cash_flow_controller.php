<?php
session_start();

include("../config/db.php");

if (
    isset($_POST['description'], $_POST['montant'], $_POST['type'], $_POST['date_operation'], $_POST['fund_id']) &&
    !empty($_POST['description']) &&
    !empty($_POST['montant']) &&
    !empty($_POST['type']) &&
    !empty($_POST['date_operation']) &&
    !empty($_POST['fund_id'])
) {
    // Récupération des données
    $description = $_POST['description'];
    $montant = $_POST['montant'];
    $type = $_POST['type'];
    $date_operation = $_POST['date_operation'];
    $fund_id = $_POST['fund_id'];

    // Préparer et exécuter l'insertion
    $stmt = $pdo->prepare("INSERT INTO `cash flow` (description_cash_flow, amount_cash_flow, type_cash_flow, date_cash_flow, fund_id) 
                           VALUES (?, ?, ?, ?, ?)");

    $result = $stmt->execute([$description, $montant, $type, $date_operation, $fund_id]);

    if ($result) {
        $_SESSION['successMessage'] = "Flux ajouté avec succès !";
        header('Location: http://localhost/MaMut_web/cash_flow');  
        exit();
    } else {
        $_SESSION['errorMessage'] = "Erreur lors de l'ajout du flux.";
        header('Location: http://localhost/MaMut_web/cash_flow');  
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Tous les champs sont requis.";
    header('Location: http://localhost/MaMut_web/cash_flow');
    exit();
}
?>


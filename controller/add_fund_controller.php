<?php
session_start();
include ('../config/db.php');

$message = "";

if (
    isset($_POST['name'], $_POST['date_caisse'], $_POST['total']) &&
    !empty($_POST['name']) &&
    !empty($_POST['date_caisse']) &&
    !empty($_POST['total'])
) {
    $nom = $_POST['name'];
    $date_caisse = $_POST['date_caisse'];
    $total = $_POST['total'];

    // Récupérer le dernier solde actuel
    $result = $pdo->query("SELECT tatal_amount_fund FROM fund ORDER BY fund_id DESC LIMIT 1");
    $row = $result->fetch();

    $solde_actuel = ($row) ? $row['tatal_amount_fund'] : 0;

    // Additionner avec le montant saisi
    $nouveau_solde = $solde_actuel + $total;

    // Insérer la nouvelle caisse avec le nouveau total
    $sql = "INSERT INTO fund (
                fund_name,
                tatal_amount_fund,
                date_ceation_fund
            ) VALUES (
                :fund_name,
                :tatal_amount_fund,
                :date_ceation_fund
            )";

    $stmt = $pdo->prepare($sql);
    $fund_data = [
        'fund_name' => $nom,
        'tatal_amount_fund' => $nouveau_solde,  // ici on met le nouveau solde
        'date_ceation_fund' => $date_caisse
    ];

    $result = $stmt->execute($fund_data); 

    if ($result) {
        $_SESSION['successMessage'] = "Caisse ajoutée avec succès !";
        header('Location: http://localhost/MaMut_web/add_fund');  
        exit();
    } else {
        $_SESSION['errorMessage'] = "Erreur lors de l'ajout de la caisse.";
        header('Location: http://localhost/MaMut_web/add_fund');  
        exit();
    }
} else {
    $_SESSION['errorMessage'] = "Tous les champs sont requis.";
    header('Location: http://localhost/MaMut_web/add_fund');
    exit();
}
?>

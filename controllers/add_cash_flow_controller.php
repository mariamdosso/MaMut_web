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
    
    $description = $_POST['description'];
    $montant = $_POST['montant'];
    $type = $_POST['type'];
    $date_operation = $_POST['date_operation'];
    $fund_id = $_POST['fund_id'];

    $stmt = $pdo->prepare("INSERT INTO cash_flow (description_cash_flow, amount_cash_flow, type_cash_flow, date_cash_flow, fund_id) 
                           VALUES (?, ?, ?, ?, ?)");

    $result = $stmt->execute([$description, $montant, $type, $date_operation, $fund_id]);

    if ($result) {
        if ($type == "entrer"){
        $sql = "UPDATE fund
                SET tatal_amount_fund =  tatal_amount_fund + :montant
                WHERE fund_id = :fund_id";
            }else {
                $sql = "UPDATE fund
                SET tatal_amount_fund =  tatal_amount_fund - :montant
                WHERE fund_id = :fund_id";
            }
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':montant' => $montant,
            ':fund_id' => $fund_id
        ]);


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


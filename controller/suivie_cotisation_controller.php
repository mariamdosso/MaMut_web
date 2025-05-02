<?php
include("../config/db.php"); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cotisation = $_POST['cotisation'];

  if ($cotisation === 'oui') {
    if (!empty($_POST['member'])) {
      $membres = $_POST['member'];

      foreach ($membres as $member_id) {
        $stmt = $pdo->prepare("INSERT INTO participation (member_id, added_date) VALUES (:member_id, :added_date");
        $stmt->execute([$member_id]);
      }

      echo "Cotisation enregistrée pour les membres sélectionnés.";
    } else {
      echo "Aucun membre sélectionné.";
    }
  } else {
    echo "Pas de cotisation.";
  }
}
?>

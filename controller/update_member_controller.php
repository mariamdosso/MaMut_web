<?php
require 'fonction_controller.php';  

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$member = getMemberById($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    if (updateMember($pdo, $_POST)) {
        header("Location: http://localhost/MaMut_web/member_list");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
 ?>


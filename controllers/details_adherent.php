<?php
include("config/db.php");

// Récupérer l'ID passé en GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id <= 0){
    echo "ID invalide";
    exit;
}

// Récupérer les infos de l'adhérent
$stmt = $pdo->prepare("SELECT * FROM adherent WHERE id = ?");
$stmt->execute([$id]);
$adherent = $stmt->fetch();


// Appeler la vue
require("views/details_info_adherent.php");
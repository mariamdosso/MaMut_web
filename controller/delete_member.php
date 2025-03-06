<?php
include "../db.php"; // Connexion à la base de données

// Vérifier si un ID est passé
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du membre manquant !");
}

$id = (int) $_GET['id']; // Sécurisation de l'ID

// Supprimer le membre
$deleteQuery = $pdo->prepare("DELETE FROM membres WHERE id = :id");
$deleteQuery->execute(['id' => $id]);

echo "<script>alert('Membre supprimé avec succès !'); window.location.href='member_list.php';</script>";
?>

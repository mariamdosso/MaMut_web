<?php
include("config/db.php");
session_start();

if (!isset($_SESSION['user_info'])) {
    header('Location: login.php'); // même dossier
    exit();
}

// Test affichage
echo "<h1>Bienvenue " . $_SESSION['user_info']['login'] . "</h1>";

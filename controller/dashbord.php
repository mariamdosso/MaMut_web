<?php
include("config/db.php");
session_start();

if (!isset($_SESSION['id'])) {
    header('Location:http://localhost/MaMut_web/Home');
    exit();
}

// Test affichage
echo "<h1>Bienvenue " . $_SESSION['user_info']['login'] . "</h1>";

<!-- <?php
// $host = "localhost";      // Adresse du serveur (localhost en local)
// $dbname = "gestion_mutuel";  // Nom de ta base de données
// $username = "root";       // Nom d'utilisateur (par défaut sous WAMP/XAMPP)
// $password = "";           // Mot de passe (laisser vide sous WAMP)

// try {
//     // Connexion à la base de données avec PDO
//     $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

//     // Configuration de PDO pour afficher les erreurs en cas de problème
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     // En cas d'erreur de connexion, afficher un message et arrêter le script
//     die("Erreur de connexion à la base de données : " . $e->getMessage());
// }
?> -->

<?php

$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=gestion_mutuel;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>



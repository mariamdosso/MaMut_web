<!-- <?php
// $host = "localhost";      
// $dbname = "gestion_mutuel";  
// $username = "root";       
// $password = "";           

// try {
//     
//     $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

//     
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
/
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



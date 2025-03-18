<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

<?php

$url = rtrim($_SERVER["REQUEST_URI"], "/");

if (strpos($url, '/MaMut_web/controller/') === 0) {
    return;
}
if (isset($_SESSION["user_token"]) ){
require("vews/layout/dashboard.php");
} else{
    switch ($url){

        case '/MaMut_web/login':
            require 'vews/login.php';
            break;
        case '/MaMut_web/register':
            require("vews/create.php");   
            break;
        default:
            require("vews/login.php");
    } 
}

?>
   <script src="assets/js/bootstrap.bundle.min.js"> </script>
</body>

</html>

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
// var_dump($_SERVER["REQUEST_URI"]);
//var_dump($_SERVER);

$url = rtrim($_SERVER["REQUEST_URI"], "/");

switch ($url){

    case '/MaMut_web/login':
        require 'vews/login.php';
        break;
    case '/MaMut_web/register':
        require("vews/create.php");   
        break;
    case '/MaMut_web/tableau':
        require("vews/tableau_bord.php");   
        break;
    case '/MaMut_web/add_member':
        require("vews/ajout_membre.php");   
        break;
     case '/MaMut_web/caisse':
         require("vews/Liste_caisses.php");   
         break;
    case '/MaMut_web/liste_member':
        require("vews/Liste_des_membre.php");   
        break;

    case '/MaMut_web/add_even':
         require("vews/form_evenement.php");   
         break;
    case '/MaMut_web/liste_even':
         require("vews/liste_evenement.php");   
         break;
    
    default:
        require("vews/login.php");
}
?>
   <script src="assets/js/bootstrap.bundle.min.js"> </script>
</body>

</html>
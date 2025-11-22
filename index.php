<?php
session_start();
include("config/db.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="/assets/css/style_global.css">
    <link rel="stylesheet" href="/assets/css/pages/login.css">
    <link rel="stylesheet" href="/assets/css/pages/adherent.css">
    <link rel="stylesheet" href="/assets/css/pages/details_adherent.css">
    <link rel="stylesheet" href="/assets/css/pages/edit_membre.css">
    <link rel="stylesheet" href="/assets/css/pages/event_add.css">
    <link rel="stylesheet" href="/assets/css/pages/list_event.css">
</head>

<body>
<div class="d-flex flex-column flex-root">

    <?php
    $url = rtrim($_SERVER["REQUEST_URI"], "/");

    if (strpos($url, '/MaMut_web/controller/') === 0) {
        return;
    }

    if (isset($_SESSION["user_token"])) {
        require("vews/layout/dashboard.php");
    } else {
        switch ($url) {
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



?>
</div>

   <script src="/assets/js/popper.min.js" defer> </script>
   <script src="/assets/js/jquery-3.6.0.min.js" defer> </script>
   <script src="/assets/js/select2.min.js" defer> </script>
    <script src="/assets/js/bootstrap.bundle.min.js" defer> </script>
    <script src="/assets/js/event.js" defer> </script>
</body>

</html>
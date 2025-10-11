<?php
session_start();
include("config/db.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaMut Web</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight&display=swap" rel="stylesheet">

    <!-- Bootstrap / Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Metronic CSS -->
    <!-- <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="assets/css/style_global.css">
    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script> -->

</head>

<body>

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



</body>

</html>
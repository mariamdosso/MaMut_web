<?php
include("config/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:MaMut_web/login');
    exit;
}

?>
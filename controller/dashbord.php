<?php
include("config/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:http://localhost/MaMut_web/Home');
    exit();
}
?>
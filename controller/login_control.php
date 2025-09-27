<?php
session_start();

include("../config/db.php");
$message = '';

if (isset($_POST['login'], $_POST['password']) && !empty($_POST['login']) && !empty($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_info'] = $user;
        $_SESSION['user_token'] = uniqid('', true);
        header('Location: dashbord.php');
        exit();
    } else {
        $_SESSION["message"] = 'Mauvais identifiants';
        header('Location: login.php');
        exit();
    }
} else {
    $_SESSION["message"] = 'Veuillez remplir tous les champs';
    header('Location: login.php');
    exit();
}

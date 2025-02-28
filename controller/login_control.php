<?php
session_start(); 

include("../config/db.php");
$message = '';

if ((!isset($_POST['email']) && !isset($_POST['password'])) && (!empty($_POST['email']) && !($_POST['password']))); {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE user_email = :user_email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['user_password'])) {
        $_SESSION['user_info'] = $user;
        $_SESSION['user_token'] = uniqid('', true); 
        header('Location:http://localhost/MaMut_web/tableau');
        // exit();
    } else {
        $_SESSION["message"] = 'Mauvais identifiants';
        header('Location:http://localhost/MaMut_web/login');
    }
}

?>

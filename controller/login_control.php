<?php
session_start(); 

include("../config/db.php");
$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE user_email = :user_email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_email' => $email]);
    $user = $stmt->fetch();

    exit;
    if ($user && password_verify($password, $user['user_password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['user_name']; 
        header('Location: tableau');
        exit;
    } else {
        $message = 'Mauvais identifiants';
    }
}

?>

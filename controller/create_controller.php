<?php 
session_start();
include("../config/db.php");

$message = '';

if (isset($_POST['name'], $_POST['password'], $_POST['email'], $_POST['confirm_password']) 
    && !empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['confirm_password'])) {

    $name = htmlspecialchars($_POST['name']); 
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password']; 
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Les mots de passe ne correspondent pas.";
        exit(); 
    } 
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO user (user_name, user_password, user_email) VALUES (:user_name, :user_password, :user_email)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        'user_name' => $name,
        'user_password' => $hashed_password,
        'user_email' => $email
    ]);

    if ($result) {
        $_SESSION['message'] = "inscription reussi";
        header('Location:http://localhost/MaMut_web/login');
        exit();
    } else {
        $_SESSION['message'] = 'Erreur lors de l\'inscription.';

    }
}
?>

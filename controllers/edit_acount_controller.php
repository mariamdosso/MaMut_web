<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("../config/db.php");



if (!isset($_SESSION['user_info'])) {
    header("Location: /MaMut_web/login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $oldPassword     = trim($_POST['old_password'] ?? '');
    $newPassword     = trim($_POST['new_password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');
    $newLogin        = trim($_POST['login'] ?? '');

    if (empty($newLogin) || empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $_SESSION["error"] = "Tous les champs sont requis.";
        header("Location: /MaMut_web/modifier_compte");
        exit;
    }

    $stmt = $pdo->prepare("SELECT password FROM user WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_info']['id']]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($oldPassword, $user['password'])) {
        $_SESSION["error"] = "L'ancien mot de passe est incorrect.";
        header("Location: /MaMut_web/modifier_compte");
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        $_SESSION["error"] = "Le nouveau mot de passe et sa confirmation ne correspondent pas.";
        header("Location: /MaMut_web/modifier_compte");
        exit;
    }

    
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $update = "UPDATE user SET login = :login, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($update);
    $stmt->execute([
        'login'    => $newLogin,
        'password' => $hashedPassword,
        'id'       => $_SESSION['user_info']['id']
    ]);

    
    $_SESSION['user_info']['login'] = $newLogin;
    $_SESSION["message"] = "Votre compte a été mis à jour avec succès.";

    header("Location: /MaMut_web/modifier_compte");
    exit;
} else {
    header("Location: /MaMut_web/modifier_compte");
    exit;
}

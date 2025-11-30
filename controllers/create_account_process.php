<?php
session_start();
include("../config/db.php");


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adherent_id = intval($_POST['adherent_id']);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $roles = $_POST['roles'] ?? [];


    if (empty($login) || empty($password) || empty($roles)) {
        die("Tous les champs sont obligatoires (login, mot de passe, rôles).");
    }

    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    $stmt = $pdo->prepare("SELECT id FROM `user` WHERE adherent_id = ?");
    $stmt->execute([$adherent_id]);
    if ($stmt->fetch()) {
        die("Un compte existe déjà pour cet adhérent.");
    }


    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO `user` (login, password, status, adherent_id) 
                               VALUES (?, ?, ?, ?)");

        $ok = $stmt->execute([$login, $hashed_password, "active", $adherent_id]);

        $user_id = $pdo->lastInsertId();

        $stmt_role = $pdo->prepare("INSERT INTO `user_role` (user_id, role_id, status) 
                                    VALUES (?, ?, ?)");
        foreach ($roles as $role_id) {
            $stmt_role->execute([$user_id, $role_id, "active"]);
        }

        $pdo->commit();

        $_SESSION['successMessage'] = "Compte de l'adhérent créé avec succès !";
        header('location://localhost/MaMut_web/member_list');
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Erreur lors de la création du compte : " . $e->getMessage());
    }
}

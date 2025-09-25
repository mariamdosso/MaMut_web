<?php
session_start();
include("../config/db.php");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (
    isset($_POST['login'], $_POST['statut'], $_POST['password'], $_POST['confirm_password'], $_POST['adherent_id']) &&
    !empty($_POST['login']) && !empty($_POST['statut']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['adherent_id'])
) {
    $login = trim($_POST['login']); 
    $statut = htmlspecialchars(trim($_POST['statut']));
    $password = $_POST['password']; 
    $confirm_password = $_POST['confirm_password'];
    $adherent_id = intval($_POST['adherent_id']);

    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
    
    } elseif (preg_match("/^(?:\+225)?0[0-9]{9}$/", $login)) {

    } else {
        $_SESSION['message'] = "Veuillez entrer un email ou un numéro de téléphone valide.";
        header('Location: /MaMut_web/register');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Les mots de passe ne correspondent pas.";
        header('Location: /MaMut_web/register');
        exit(); 
    }

    $check = $pdo->prepare("SELECT id FROM user WHERE login = :login");
    $check->execute(['login' => $login]);
    if ($check->fetch()) {
        $_SESSION['message'] = "Ce login existe déjà. Veuillez en choisir un autre.";
        header('Location: /MaMut_web/register');
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO user (login, status, password, adherent_id) 
                VALUES (:login, :status, :password, :adherent_id)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            'login' => $login,
            'status' => $statut, 
            'password' => $hashed_password,
            'adherent_id' => $adherent_id
        ]);

        if ($result) {
            $_SESSION['message'] = "Inscription réussie 🎉 Connectez-vous maintenant.";
            header('Location: /MaMut_web/login');
            exit();
        } else {
            $_SESSION['message'] = "Erreur lors de l'inscription. Réessayez.";
            header('Location: /MaMut_web/register');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur technique : " . $e->getMessage();
        header('Location: /MaMut_web/register');
        exit();
    }

} else {
    $_SESSION['message'] = "Veuillez remplir tous les champs.";
    header('Location: /MaMut_web/register');
    exit();
}

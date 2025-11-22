<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Vérifie si les champs ont été remplis
if (isset($_POST['login'], $_POST['password']) && !empty($_POST['login']) && !empty($_POST['password'])) {

    $login = trim($_POST['login']);
    $password = $_POST['password'];

    // Cherche l'utilisateur par login
    $sql = "SELECT * FROM user WHERE login = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérifie le mot de passe
        if (password_verify($password, $user['password'])) {
            // Supprime le mot de passe avant d’enregistrer en session
            unset($user['password']);
            $_SESSION['user_info'] = $user;
            $_SESSION['user_token'] = bin2hex(random_bytes(16));

            // Redirection vers le tableau de bord
            header('Location: ../tableau');
            exit();
        } else {
            $_SESSION["message"] = 'Mot de passe incorrect.';
            header('Location: ../views/login');
            exit();
        }
    } else {
        $_SESSION["message"] = 'Login inexistant.';
        header('Location: ../views/login');
        exit();
    }

} else {
    $_SESSION["message"] = 'Veuillez remplir tous les champs.';
    header('Location: ../views/login');
    exit();
}
?>

<?php

class AuthController
{
    public function loginView()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    // Traite le formulaire de login
    public function login()
    {
        if (
            isset($_POST['login'], $_POST['password']) &&
            !empty($_POST['login']) && !empty($_POST['password'])
        ) {

            $login = trim($_POST['login']);
            $password = $_POST['password'];

            $sql = "SELECT * FROM user WHERE login = :login";
            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->execute(['login' => $login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']);
                $_SESSION['user_info'] = $user;
                $_SESSION['user_token'] = bin2hex(random_bytes(16));
                header('Location: /MaMut_web/home'); 
                exit();
            } else {
                $_SESSION['message'] = 'Login ou mot de passe incorrect.';
                $this->loginView();
            }
        } else {
            $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            $this->loginView();
        }
    }
}

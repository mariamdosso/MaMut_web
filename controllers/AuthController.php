<?php

class AuthController
{
    public function loginView()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function login()
    {
        session_start();

        if (
            isset($_POST['login'], $_POST['password']) &&
            !empty($_POST['login']) && !empty($_POST['password'])
        ) {
            $login = trim($_POST['login']);
            $password = $_POST['password'];

            $sql = "
                SELECT 
                    u.id,
                    u.login,
                    u.password,
                    u.status,
                    u.adherent_id,
                    r.code AS role
                FROM user u
                INNER JOIN user_role ur 
                    ON ur.user_id = u.id
                    AND ur.status = 'active'
                INNER JOIN roles r 
                    ON r.id = ur.role_id
                WHERE u.login = :login
                LIMIT 1;
            ";

            $stmt = $GLOBALS['pdo']->prepare($sql);
            $stmt->execute(['login' => $login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']);
                $_SESSION['user_info'] = [
                    'id'          => $user['id'],
                    'login'       => $user['login'],
                    'role'        => $user['role'] ?? 'guest',
                    'adherent_id' => $user['adherent_id'],
                    'status'      => $user['status']
                ];

                $_SESSION['user_token'] = bin2hex(random_bytes(16));

                header('Location: /MaMut_web/home');
                exit();
            }

            $_SESSION['message'] = 'Login ou mot de passe incorrect.';
            $this->loginView();
        } else {
            $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            $this->loginView();
        }
    }

}

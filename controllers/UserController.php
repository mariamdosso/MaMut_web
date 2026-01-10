<?php

require_once __DIR__ . '/../Models/User.php';

class UserController
{
    public function logout()
    {
        User::logout();

        header("Location: /MaMut_web/login");
        exit();
    }

    public function showEditAccount()
    {
        ob_start();
        require __DIR__ . '/../views/adherents/edit_account.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout/dashboard.php';
    }
   
}
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
        require __DIR__ . '/../views/edit_account.php';
    }
   
}
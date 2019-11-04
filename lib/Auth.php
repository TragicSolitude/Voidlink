<?php
namespace Lib;

use App\Models\User;

class Auth
{
    public $cur_user;

    function __construct()
    {
        $this->cur_user = unserialize(
            $_SESSION['auth'],
            ["allowed_classes" => ["App\\Models\\User"]]
        ) ?: null;
    }

    function login(User $user)
    {
        $_SESSION['auth'] = serialize($user);
    }

    function logout()
    {
        unset($_SESSION['auth']);
    }
}

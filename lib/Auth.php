<?php
namespace Lib;

class Auth
{
    function userid()
    {
        return $_SESSION['auth'];
    }

    function is_logged_in(): bool
    {
        return isset($_SESSION['auth']);
    }

    function login(int $userid)
    {
        $_SESSION['auth'] = $userid;
    }

    function logout()
    {
        unset($_SESSION['auth']);
    }
}

<?php
namespace App\Dto;

use Lib\Dto;

class LoginDto extends Dto
{
    public $username;
    public $password;

    function __construct()
    {
        $this->username = filter_input(
            INPUT_POST,
            "username",
            FILTER_SANITIZE_STRING
        );
        $this->password = filter_input(
            INPUT_POST,
            "password",
            FILTER_SANITIZE_STRING
        );
    }

    function is_invalid(array &$errors): bool
    {
        $_SESSION["form"] = $_POST;

        if (empty($this->username))
        {
            $errors[] = "Please enter a username";
        }
        if (empty($this->password))
        {
            $errors[] = "Please enter a password";
        }

        return count($errors) > 0;
    }
}

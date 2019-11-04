<?php
namespace App\Dto;

use Lib\Dto;

class RegisterDto extends Dto
{
    public $email;
    public $username;
    public $password;
    public $confirmpassword;

    function __construct()
    {
        $this->email = filter_input(
            INPUT_POST,
            "email",
            FILTER_VALIDATE_EMAIL
        );
        // For consistency the username and password filters should be
        // identical to those in LoginDto
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
        $this->confirmpassword = filter_input(
            INPUT_POST,
            "confirmpassword",
            FILTER_SANITIZE_STRING
        );
    }

    function is_invalid(array &$errors): bool
    {
        $_SESSION["form"] = $_POST;

        if (empty($this->email))
        {
            $errors[] = "Please enter a valid email address";
        }
        if (empty($this->username))
        {
            $errors[] = "Please enter a username";
        }
        if (empty($this->password))
        {
            $errors[] = "Please enter a password";
        }
        if ($this->password !== $this->confirmpassword)
        {
            $errors[] = "Passwords do not match";
        }

        return count($errors) > 0;
    }
}

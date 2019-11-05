<?php
namespace App\Dto;

use Lib\Dto;

/**
 * Parse and validate a login form entry
 */
class LoginDto extends Dto
{
    public $username;
    public $password;

    function __construct()
    {
        // These filters need to match those in RegistrationDto to ensure
        // consistent behavior on the user's side regarding special characters
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
        // Save the form entry to session to refill on error
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

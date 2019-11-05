<?php
namespace App\Controllers;

use Lib\Controller;
use App\Dto\LoginDto;
use App\Dto\RegisterDto;
use App\Dao\UserDao;
use App\Dao\ImageDao;

class LoginController extends Controller
{
    /**
     * GET /login or /login/index
     */
    function get_index()
    {
        $this->vm->page_title = "Login";
        $this->vm->errors = $this->errors;

        return "login/index";
    }

    /**
     * POST /login/dologin
     */
    function post_dologin()
    {
        $login = new LoginDto();
        if ($login->is_invalid($this->errors))
        {
            return "go_back";
        }

        $user = UserDao::validate_login($login);

        if (is_null($user))
        {
            $this->errors[] = "Invalid Login";
            return "go_back";
        }

        $this->auth->login($user);

        return "see:/";
    }

    /**
     * GET /login/dologout
     *
     * This is a GET route instead of POST like the other so that a simple <a>
     * tag to this route can be tossed wherever instead of a full <form>
     */
    function get_dologout()
    {
        // If not logged in then this does nothing
        $this->auth->logout();

        return "see:/";
    }

    /**
     * GET /login/register
     */
    function get_register()
    {
        $this->vm->page_title = "Register";
        $this->vm->errors = $this->errors;

        return "login/register";
    }

    /**
     * POST /login/doregister
     */
    function post_doregister()
    {
        $login = new RegisterDto();
        if ($login->is_invalid($this->errors))
        {
            return "go_back";
        }

        // Make sure username is unique. Don't care about email uniqueness
        if (!UserDao::is_username_available($login->username))
        {
            $this->errors[] = "Username already taken";
            return "go_back";
        }

        $uuid = null;
        if (isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["tmp_name"]))
        {
            // If a file was uploaded validate it and save it
            $file = $_FILES["profilepic"];
            if (!exif_imagetype($file["tmp_name"]))
            {
                $this->errors[] = "Invalid image";
                return "go_back";
            }

            $uuid = ImageDao::upload_image($file["tmp_name"]);
            if (is_null($uuid))
            {
                $this->errors[] = "Error uploading image";
                return "go_back";
            }
        }

        // Create a new user with the given information
        if (!UserDao::register_user($login, $uuid))
        {
            $this->errors[] = "Unknown error occurred";
            return "go_back";
        }

        // Redirect to login page
        return "see:/login";
    }
}

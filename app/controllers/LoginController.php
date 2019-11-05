<?php
namespace App\Controllers;

use Lib\Controller;
use App\Dto\LoginDto;
use App\Dto\RegisterDto;
use App\Dao\UserDao;
use App\Dao\ImageDao;

class LoginController extends Controller
{
    function get_index()
    {
        $this->vm->page_title = "Login";
        $this->vm->errors = $this->errors;

        return "login/index";
    }

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

    function get_dologout()
    {
        // If not logged in then this does nothing
        $this->auth->logout();

        return "see:/";
    }

    function get_register()
    {
        $this->vm->page_title = "Register";
        $this->vm->errors = $this->errors;

        return "login/register";
    }

    function post_doregister()
    {
        $login = new RegisterDto();
        if ($login->is_invalid($this->errors))
        {
            return "go_back";
        }

        if (!UserDao::is_username_available($login->username))
        {
            $this->errors[] = "Username already taken";
            return "go_back";
        }

        $uuid = null;
        if (isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["tmp_name"]))
        {
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

        if (!UserDao::register_user($login, $uuid))
        {
            $this->errors[] = "Unknown error occurred";
            return "go_back";
        }

        return "see:/login";
    }
}

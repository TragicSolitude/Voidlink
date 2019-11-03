<?php
namespace App\Controllers;

use Lib\Controller;
use App\Dto\LoginDto;
use App\Repositories\UserRepository;

class LoginController extends Controller
{
    function get_index()
    {
        $this->vm->page_title = "Login";
        $this->vm->errors = $this->errors;
        $this->vm->form = $_SESSION["form"];

        return "login/index";
    }

    function get_register()
    {

    }

    function post_dologin()
    {
        $login = new LoginDto();
        if ($login->is_invalid($this->errors))
        {
            return "go_back";
        }

        $userid = UserRepository::validate_login($login);

        if (is_null($userid))
        {
            $this->errors[] = "Invalid Login";
            return "go_back";
        }

        $this->auth->login($userid);

        return "see:/";
    }

    function post_dologout()
    {
        if (!$this->auth->is_logged_in())
        {
            return "see:/";
        }

        $this->auth->logout();

        return "see:/";
    }

    function post_doregister()
    {

    }
}

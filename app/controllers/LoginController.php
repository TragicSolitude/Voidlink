<?php
namespace App\Controllers;

use Lib\Controller;
use App\Dto\LoginDto;
use App\Dao\UserDao;

class LoginController extends Controller
{
    function get_index()
    {
        $this->vm->page_title = "Login";
        $this->vm->errors = $this->errors;

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

    function post_doregister()
    {

    }
}

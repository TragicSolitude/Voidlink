<?php
namespace App\Controllers;

use Lib\Controller;

class LoginController extends Controller
{
    function get_index()
    {
        $this->vm->page_title = "Login";

        return "login/index";
    }
}

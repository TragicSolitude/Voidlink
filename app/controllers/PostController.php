<?php
namespace App\Controllers;

use Lib\Controller;

class PostController extends Controller
{
    function get_new()
    {
        $this->vm->page_title = "New Post";

        return "post/new";
    }

    function post_create()
    {
        return "see:/";
    }
}

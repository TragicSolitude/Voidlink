<?php
namespace App\Controllers;

use App\Dto\PostDto;
use App\Repositories\PostRepository;
use Lib\Controller;

class PostController extends Controller
{
    function get_new()
    {
        // TODO Make this into a centralized security service?
        if (!$this->auth->is_logged_in())
        {
            return "see:/login";
        }

        $this->vm->page_title = "New Post";
        $this->vm->errors = $this->errors;
        $this->vm->form = $_SESSION["form"];

        return "post/new";
    }

    function post_create()
    {
        if (!$this->auth->is_logged_in())
        {
            return "see:/login";
        }

        $post = new PostDto();
        if ($post->is_invalid($this->errors))
        {
            return "go_back";
        }

        PostRepository::create_post(1, $post);
        return "see:/";
    }
}

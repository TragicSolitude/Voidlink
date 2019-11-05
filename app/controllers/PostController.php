<?php
namespace App\Controllers;

use App\Dao\ImageDao;
use App\Dto\PostDto;
use App\Dao\PostDao;
use Lib\Controller;

class PostController extends Controller
{
    /**
     * GET /post/new
     */
    function get_new()
    {
        // TODO Make this into a centralized security service?
        if (!$this->auth->cur_user)
        {
            return "see:/login";
        }

        $this->vm->page_title = "New Post";
        $this->vm->errors = $this->errors;
        $this->vm->form = $_SESSION["form"];

        return "post/new";
    }

    /**
     * POST /post/create
     */
    function post_create()
    {
        // Enforce user is logged in
        if (!$this->auth->cur_user)
        {
            return "see:/login";
        }

        $post = new PostDto();
        if ($post->is_invalid($this->errors))
        {
            return "go_back";
        }

        $uuid = null;
        if (isset($_FILES["postimage"]) && !empty($_FILES["postimage"]["tmp_name"]))
        {
            // If a file was uploaded validate it and save it
            $file = $_FILES["postimage"];
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

        $id = PostDao::create_post($this->auth->cur_user, $post);

        if (!is_null($uuid))
        {
            // If any images were uploaded save them to the post images table
            PostDao::attach_image_to_post($id, $uuid);
        }

        return "see:/";
    }
}

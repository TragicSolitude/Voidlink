<?php
namespace App\Dto;

use Lib\Dto;

class PostDto extends Dto
{
    public $content;

    function __construct()
    {
        $this->content = filter_input(
            INPUT_POST,
            "content",
            FILTER_SANITIZE_STRING
        );
    }

    function is_invalid(array &$errors): bool
    {
        $_SESSION["form"] = $_POST;
        if (is_null($this->content))
        {
            $errors[] = "Content is required";
        }

        return count($errors) > 0;
    }
}

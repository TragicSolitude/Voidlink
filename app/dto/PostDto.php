<?php
namespace App\Dto;

use Lib\Dto;

/**
 * Parse and validate a new post entry. Associated images are validated
 * separately.
 */
class PostDto extends Dto
{
    // TODO Maybe move image validation to DTO?
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

<?php
namespace App\Dto;

use Lib\Dto;

/**
 * Validates query string parameters for post list on index page
 */
class PostListDto extends Dto
{
    public $page;
    public $count;

    function __construct()
    {
        $this->page = filter_input(
            INPUT_GET,
            "page",
            FILTER_VALIDATE_INT
        ) ?: 0;
        $this->count = 25;
    }

    function is_invalid(array &$errors): bool
    {
        return false;
    }
}

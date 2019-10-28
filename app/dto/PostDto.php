<?php
namespace App\Dto;

class PostDto extends Lib\Dto
{
    public $content;

    function __construct()
    {
        $this->content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);
    }

    function is_valid(): bool
    {
        return parent::is_valid(['content']);
    }
}

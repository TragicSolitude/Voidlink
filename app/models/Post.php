<?php
namespace App\Models;

class Post extends Model
{
    public $id;
    public $content;

    function __construct(array $fields)
    {
        $this->id = $fields['id'] ?: null;
        $this->content = $fields['content'] ?: null;
    }
}

<?php
namespace App\Models;

use Lib\Model;

class Post extends Model
{
    public $id;
    public $author;
    public $author_name;
    public $content;
    public $created;
}

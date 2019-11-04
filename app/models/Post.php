<?php
namespace App\Models;

use Lib\Model;

class Post extends Model
{
    public $id;
    public $author;
    public $content;
    public $created;
}

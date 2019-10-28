<?php
namespace App\Repositories;

use App\Dto\PostDto;

class PostRepository extends Lib\Repository
{
    function __construct()
    {
        parent::_construct("post");
    }

    function create_post(PostDto $post)
    {
        $sql = [
            "INSERT INTO {$this->table} (content)",
                "VALUES (?)"
        ];
        self::$pdo->prepare(implode(" ", $sql))
            ->execute($post->content);
    }

    // function attach_images_to_post(string $post_id, array $images)
    // {

    // }
}

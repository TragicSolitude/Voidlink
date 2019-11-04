<?php
namespace App\Dao;

use Lib\Dao;
use App\Dto\PostDto;
use App\Models\User;

class PostDao extends Dao
{
    static function create_post(User $author, PostDto $post)
    {
        $sql = [
            "INSERT INTO post (author, author_name, content)",
                "VALUES (:author, :author_name, :content)"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":author", $author->id, \PDO::PARAM_INT);
        $st->bindValue(":author_name", $author->username);
        $st->bindValue(":content", $post->content);
        $st->execute();
    }

    // function attach_images_to_post(string $post_id, array $images)
    // {

    // }

    static function get_posts(int $count = 25, int $offset = 0): array
    {
        $sql = [
            "SELECT *",
            "FROM post",
            "ORDER BY created",
            "LIMIT :offset, :count"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":offset", $offset, \PDO::PARAM_INT);
        $st->bindvalue(":count", $count, \PDO::PARAM_INT);
        if (!$st->execute())
        {
            return [];
        }

        return $st->fetchAll(\PDO::FETCH_CLASS, "App\\Models\\Post");
    }
}

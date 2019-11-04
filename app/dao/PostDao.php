<?php
namespace App\Dao;

use Lib\Dao;
use App\Dto\PostDto;

class PostDao extends Dao
{
    static function create_post(int $author_id, PostDto $post)
    {
        $sql = [
            "INSERT INTO post (author, content)",
                "VALUES (:author, :content)"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":author", $author_id, \PDO::PARAM_INT);
        $st->bindValue(":content", $post->content);
        $st->execute();
    }

    // function attach_images_to_post(string $post_id, array $images)
    // {

    // }

    static function get_posts(int $count = 25, int $offset = 0): array
    {
        $sql = [
            "SELECT",
                "post.content,",
                "post.created,",
                "user.username AS author",
            "FROM post",
            "JOIN user ON user.id = post.author",
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

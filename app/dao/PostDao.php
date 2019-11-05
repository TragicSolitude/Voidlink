<?php
namespace App\Dao;

use Lib\Dao;
use App\Dto\PostDto;
use App\Models\User;

class PostDao extends Dao
{
    /**
     * @return The id of the post
     */
    static function create_post(User $author, PostDto $post): int
    {
        $sql = [
            "INSERT INTO post (author, author_name, content)",
                "VALUES (:author, :author_name, :content)"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":author", $author->id, \PDO::PARAM_INT);
        $st->bindValue(":author_name", $author->username);
        $st->bindValue(":content", $post->content);
        if (!$st->execute())
        {
            throw new \PDOException("Error creating post", -1);
        }

        return self::$pdo->lastInsertId();
    }

    function attach_image_to_post(int $post_id, string $uuid)
    {
        $sql = [
            "INSERT INTO post_image (uuid, post_id)",
                "VALUES (:uuid, :post_id)"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":uuid", $uuid);
        $st->bindValue(":post_id", $post_id, \PDO::PARAM_INT);
        $st->execute();
    }

    static function get_posts(int $count = 25, int $offset = 0): array
    {
        $sql = [
            "SELECT *, uuid AS image",
            "FROM post",
            "LEFT OUTER JOIN post_image ON post.id = post_image.post_id",
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

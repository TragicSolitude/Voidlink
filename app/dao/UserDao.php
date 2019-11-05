<?php
namespace App\Dao;

use Lib\Dao;
use App\Dto\LoginDto;
use App\Dto\RegisterDto;
use App\Models\User;

class UserDao extends Dao
{
    /**
     * Validate the given login dto against the database.
     *
     * @param $login
     * @return The id of the user if successful or NULL on failure
     */
    static function validate_login(LoginDto $login): ?User
    {
        $sql = [
            "SELECT * FROM user",
            "WHERE 1",
                "AND username = :username"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":username", $login->username);
        if (!$st->execute())
        {
            return NULL;
        }

        $user = $st->fetchObject("App\\Models\\User");
        if (!$user)
        {
            return NULL;
        }

        if (!password_verify($login->password, $user->password))
        {
            return NULL;
        }

        return $user;
    }

    /**
     * Checks if a username is available to use
     */
    static function is_username_available(string $username): bool
    {
        $count = 0;

        // Is there some way to specifically catch index related errors from
        // pdo? It would remove the need for this function and would be more
        // reliable than this LBYL check.
        $sql = [
            "SELECT COUNT(1) AS count FROM user",
            "WHERE username = :username"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":username", $username);
        $st->bindColumn("count", $count, \PDO::PARAM_INT);
        if (!$st->execute())
        {
            return false;
        }

        $st->fetch(\PDO::FETCH_BOUND);
        return $count === 0;
    }

    /**
     * Registers a new user
     *
     * @return True if successful
     */
    static function register_user(RegisterDto $registration, ?string $uuid = null): bool
    {
        // DB Column is 60 wide specifically for Bcrypt hash
        $hash = password_hash(
            $registration->password,
            PASSWORD_BCRYPT,
            ["cost" => 12]
        );

        $sql = [
            "INSERT INTO user (email, username, password, role, profile_picture)",
                "VALUES (:email, :username, :password, 1, :profilepic)"
        ];
        $st = self::$pdo->prepare(implode(" ", $sql));
        $st->bindValue(":email", $registration->email);
        $st->bindValue(":username", $registration->username);
        $st->bindValue(":password", $hash);
        $st->bindValue(":profilepic", $uuid);
        return $st->execute();
    }
}

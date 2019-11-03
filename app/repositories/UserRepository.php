<?php
namespace App\Repositories;

use Lib\Repository;
use App\Dto\LoginDto;
use App\Models\User;

class UserRepository extends Repository
{
    /**
     * Validate the given login dto with the database.
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

    // static function register_user(RegistrationDto $registration): int
    // {
        // $sql = [
            // "INSERT INTO user (email, username, password)",
                // "VALUES (:email, :username, :password"
        // ];

        // return 0;
    // }
}

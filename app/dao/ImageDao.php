<?php
namespace App\Dao;

use Google\Cloud\Storage\StorageClient;

/**
 * Abstracts image operations. This isn't a db-based dao so it doesn't extend
 * Dao.
 */
class ImageDao
{
    private static $storage_client = null;

    public const IMAGE_POST = 0;
    public const IMAGE_PROFILE = 1;

    private static function get_client()
    {
        if (is_null(self::$storage_client))
        {
            self::$storage_client = new StorageClient([
                "projectId" => "void-link"
            ]);
        }

        return self::$storage_client;
    }

    static function upload_image(string $path): ?string
    {
        $client = self::get_client();
        // Prefix UUID with GAE instance to add some more uniqueness
        $prefix = $_SERVER["GAE_INSTANCE"] ?: "";
        $uuid = uniqid($prefix, true);

        $object = $client
            ->bucket("void-link.appspot.com")
            ->upload(fopen($path, "r"), [
                "name" => $uuid
            ]);

        if (empty($object))
        {
            return null;
        }

        return $uuid;
    }
}

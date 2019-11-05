<?php
namespace App\Dao;

use Google\Cloud\Storage\StorageClient;

/**
 * Abstracts image operations. This is an api-based dao rather than a db-based
 * one.
 */
class ImageDao
{
    private static $storage_client = null;

    public const IMAGE_POST = 0;
    public const IMAGE_PROFILE = 1;

    /**
     * Gets an instance of StorageClient authenticated to the "void-link"
     * project
     */
    private static function get_client()
    {
        // Use singleton-like pattern for client to avoid authenticating
        // multiple times
        if (is_null(self::$storage_client))
        {
            self::$storage_client = new StorageClient([
                "projectId" => "void-link"
            ]);
        }

        return self::$storage_client;
    }

    /**
     * Uploads an image by path to Google Cloud Storage in the
     * void-link.appspot.com bucket and returns the unique id created and used
     * as the filename
     *
     * @return The generated unique id used as the filename.
     */
    static function upload_image(string $path): ?string
    {
        $client = self::get_client();
        // Prefix UUID with GAE instance to add some more uniqueness when
        // deployed
        $prefix = $_SERVER["GAE_INSTANCE"] ?: "";
        $uuid = uniqid($prefix, true);

        $object = $client
            ->bucket("void-link.appspot.com")
            ->upload(fopen($path, "r"), [
                "name" => $uuid
            ]);

        // Return null in case the object fails to upload for some reason
        if (empty($object))
        {
            return null;
        }

        return $uuid;
    }
}

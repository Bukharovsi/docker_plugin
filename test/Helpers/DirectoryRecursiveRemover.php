<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 06.02.17
 * Time: 16:36
 */

namespace Bukharovsi\DockerPlugin\Test\Helpers;


class DirectoryRecursiveRemover
{
    public static function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        static::rrmdir($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        }
    }
}
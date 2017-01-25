<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 24.01.17
 * Time: 16:04
 */

namespace Bukharovsi\DockerPlugin\Docker\Image;


use Bukharovsi\DockerPlugin\Docker\Image\Tag;

/**
 * Class BuiltImage
 *
 * Image building result, contains image tags
 *
 * @package Bukharovsi\DockerPlugin\Docker\Image\Report
 */
class BuiltImage
{

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * ImageBuiltReport constructor.
     * @param \Bukharovsi\DockerPlugin\Docker\Image\Tag[] $tags
     */
    public function __construct(array $tags)
    {
        $this->tags = $tags;
    }

    public function tags()
    {
        return $this->tags;
    }

    public function versions()
    {
        $versions = [];
        foreach ($this->tags as $tag) {
            $versions[] = $tag->version();
        }
        return $versions;
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 18:09
 */

namespace Bukharovsi\DockerPlugin\Docker;

use Bukharovsi\DockerPlugin\Docker\Tag\Tag;

/**
 * Class DockerCommandPush
 *
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerCommandPush
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * @param $tag
     */
    public function setImageName($tag)
    {
        $this->tag = $tag;
    }

    public function buildCommand()
    {
        $command = 'docker push ' . $this->tag;

        return $command;
    }
}

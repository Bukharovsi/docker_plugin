<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 18:09
 */

namespace Bukharovsi\DockerPlugin\Docker;

/**
 * Class DockerCommandPush
 *
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerCommandPush
{
    /**
     * @var string
     */
    private $imageName = '';

    /**
     * @param $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function buildCommand()
    {
        $command = 'docker push ' . $this->imageName;

        return $command;
    }
}

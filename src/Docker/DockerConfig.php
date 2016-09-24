<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 16:35
 */

namespace Bukharovsi\DockerPlugin\Docker;

/**
 * Class DockerConfig
 *
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerConfig
{
    /**
     * @var string
     */
    private $imageName;

    /**
     * @var string
     */
    private $imageTag;

    /**
     * @param string $imageName
     *
     * @return $this
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param string $imageTag
     *
     * @return $this
     */
    public function setImageTag($imageTag)
    {
        $this->imageTag = $imageTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageTag()
    {
        return $this->imageTag;
    }
}
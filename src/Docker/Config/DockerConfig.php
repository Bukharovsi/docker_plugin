<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 16:35
 */

namespace Bukharovsi\DockerPlugin\Docker\Config;

/**
 * Class DockerConfig
 *
 * todo. оставлять. нам надо где хранить настройки для плагина, либо в этом объекте,
 * либо в массиве, либо при каждой надобности пересобирать параметр
 *
 * @package Bukharovsi\DockerPlugin\Docker\Config
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
     * @var string
     */
    private $workingDirectory;

    /**
     * @var string
     */
    private $dockerfile;

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

    /**
     * @param string $workingDirectory
     *
     * @return $this
     */
    public function setWorkingDirectory($workingDirectory)
    {
        $this->workingDirectory = $workingDirectory;

        return $this;
    }

    /**
     * @return string
     */
    public function getWorkingDirectory()
    {
        return $this->workingDirectory;
    }

    /**
     * @param string $dockerfile
     *
     * @return $this
     */
    public function setDockerfile($dockerfile)
    {
        $this->dockerfile = $dockerfile;

        return $this;
    }

    /**
     * @return string
     */
    public function getDockerfile()
    {
        return $this->dockerfile;
    }
}
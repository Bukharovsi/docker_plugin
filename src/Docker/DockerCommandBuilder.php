<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 08.09.16
 * Time: 14:25
 */

namespace Bukharovsi\DockerPlugin\Docker;

use Bukharovsi\DockerPlugin\Docker\Tag\Dockerfile;
use Bukharovsi\DockerPlugin\Docker\Tag\Tag;
use Composer\Util\Filesystem;

/**
 * Class DockerCommandBuilder
 *
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerCommandBuilder
{
    /**
     * @var string
     */
    private $workingDirectory;

    /**
     * @var Tag[]
     */
    private $tags = [];

    /**
     * docker file name
     *
     * @var string
     */
    private $dockerfile;


    /**
     * DockerCommandBuilder constructor.
     */
    public function __construct()
    {
        $this->useDefaultWorkingDirectory();
        $this->useDefaultDockerfile();
    }

    /**
     * Build a docker command for building iamge
     *
     * @return string
     */
    public function buildCommand()
    {
        $command = 'docker build ';

        foreach ($this->tags as $tag) {
            $command .= "-t $tag ";
        }

        if ($this->isNeedSpecifyDockerfile()) {
            $command .= "-f $this->dockerfile";
        }

        $command .= $this->getWorkingDirectory();

        return $command;
    }

    /**
     * Add a tag to docker image
     *
     * @param Tag $tag docker image tag. format name:[version]
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        array_push($this->tags, $tag);

        return $this;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Specify dockerfile if it is need to use not default (Dockerfile)
     *
     * @param string $dockerfileName
     * @return $this
     */
    public function specifyDockerfile($dockerfileName)
    {
        $this->dockerfile = $dockerfileName;

        return $this;
    }

    /**
     * use default dockerfile
     *
     * @return $this
     */
    public function useDefaultDockerfile()
    {
        $this->dockerfile = Dockerfile::DEFAULT_DOCKER_FILE;

        return $this;
    }

    protected function isNeedSpecifyDockerfile()
    {
        return $this->dockerfile !== Dockerfile::DEFAULT_DOCKER_FILE;
    }

    public function getDockerfile()
    {
        return $this->dockerfile;
    }

    /**
     * @return string
     */
    public function getWorkingDirectory()
    {
        return $this->workingDirectory;
    }

    /**
     * @param string $workingDirectory
     * @return $this
     */
    public function specifyWorkingDirectory($workingDirectory)
    {
        $this->workingDirectory = $workingDirectory;

        return $this;
    }

    /**
     * Use project root as default working directory
     *
     * @return $this
     */
    public function useDefaultWorkingDirectory()
    {
        $this->workingDirectory = $this->getProjectRootPath();

        return $this;
    }

    private function getProjectRootPath()
    {
        $filesystem = new Filesystem();
        $basePath = $filesystem->normalizePath(realpath(getcwd()));

        return $basePath;
    }
}

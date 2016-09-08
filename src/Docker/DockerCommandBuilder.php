<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 08.09.16
 * Time: 14:25
 */

namespace Bukharovsi\DockerPlugin\Docker;


use Bukharovsi\DockerPlugin\Docker\Tag\Tag;
use Composer\Util\Filesystem;

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
     * DockerCommandBuilder constructor.
     */
    public function __construct()
    {
        $this->useDefaultWorkingDirectory();
    }


    public function buildCommand()
    {
        return $this->createExecutableCommand();
    }

    protected function createExecutableCommand()
    {
        $command = 'docker build ';

        foreach ($this->tags as $tag) {
            $command .= "-t$tag ";
        }

        $command .= $this->getWorkingDirectory();
        return $command;
    }

    /**
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
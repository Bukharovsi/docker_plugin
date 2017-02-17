<?php

namespace Bukharovsi\DockerPlugin\Docker\Image;


use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IDockerImageConfiguration;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\ICommandBuilder;

/**
 * Class DockerImage
 *
 * Represents a Docker Image built configuration
 *
 * @package Bukharovsi\DockerPlugin\Docker\Image
 */
class DockerImage
{
    /**
     * @var String
     */
    private $dockerfile;

    /**
     * @var Tag[]
     */
    private $tags = [];

    /**
     * @var string
     */
    private $workingDirectory;

    /**
     * @var ICommandBuilder
     */
    private $commandBuilder;

    /**
     * DockerImage constructor.
     * @param IConfiguration $configuration
     * @param ICommandBuilder $commandBuilder
     */
    public function __construct(IDockerImageConfiguration $configuration, ICommandBuilder $commandBuilder)
    {
        $this->commandBuilder = $commandBuilder;
        $this->dockerfile = $configuration->dockerFilePath();
        $this->workingDirectory = $configuration->workingDirectory();

        foreach ($configuration->imageTags() as $version) {
            $this->addTag(new Tag($configuration->imageName(), $version));
        }
    }

    private function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    public function build()
    {
        $buildCommand = $this->commandBuilder->createBuildImageCommand($this->dockerfile, $this->workingDirectory, $this->tags);
        $buildCommand->execute();

        return new BuiltImage($this->tags);
    }

    public function push()
    {
        foreach ($this->tags as $tag) {
            $pushCommand = $this->commandBuilder->createPushImageCommand($tag);
            $pushCommand->execute();
        }

    }


}
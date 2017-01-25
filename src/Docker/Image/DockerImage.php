<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 18:08
 */

namespace Bukharovsi\DockerPlugin\Docker\Image;


use Bukharovsi\DockerPlugin\Docker\Configuration\IConfiguration;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\BuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\IBuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ICommandBuilder;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\PushImageCommand;

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
    public function __construct(IConfiguration $configuration, ICommandBuilder $commandBuilder)
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
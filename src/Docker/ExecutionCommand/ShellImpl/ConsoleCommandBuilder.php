<?php

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl;


use AdamBrett\ShellWrapper\Runners\Runner;
use AdamBrett\ShellWrapper\Runners\RunnerWithStandardOut;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IBuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\ICommandBuilder;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IPushImageCommand;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;

/**
 * Class ConsoleCommandBuilder
 *
 * creates docker command which uses command line
 *
 * @package Bukharovsi\DockerPlugin\Docker\ExecutionCommand
 */
class ConsoleCommandBuilder implements ICommandBuilder
{

    /**
     * @var Runner
     */
    private $commandRunner;

    /**
     * ConsoleCommandBuilder constructor.
     * @param Runner $commandRunner
     */
    public function __construct(Runner $commandRunner)
    {
        $this->commandRunner = $commandRunner;
    }


    /**
     * make build image command
     *
     * @param string $dockerfile
     * @param string $workingDirectory
     * @param Tag[] $tags
     *
     * @return IBuildImageCommand
     */
    public function createBuildImageCommand($dockerfile, $workingDirectory, array $tags)
    {
        return new BuildImageCommand($this->commandRunner, $dockerfile, $workingDirectory, $tags);
    }

    /**
     * Create push command
     *
     * @param Tag $tag
     * @return IPushImageCommand
     */
    public function createPushImageCommand(Tag $tag)
    {
        return new PushImageCommand($this->commandRunner, $tag);
    }

}
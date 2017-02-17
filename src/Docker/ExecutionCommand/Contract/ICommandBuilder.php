<?php

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract;

use Bukharovsi\DockerPlugin\Docker\Image\Tag;


/**
 * Class ConsoleCommandBuilder
 *
 * creates docker command which uses command line
 *
 * @package Bukharovsi\DockerPlugin\Docker\ExecutionCommand
 */
interface ICommandBuilder
{
    /**
     * make build image command
     *
     * @param string $dockerfile
     * @param string $workingDirectory
     * @param Tag[] $tags
     *
     * @return IBuildImageCommand
     */
    public function createBuildImageCommand($dockerfile, $workingDirectory, array $tags);

    /**
     * Create push command
     *
     * @param Tag $tag
     * @return IPushImageCommand
     */
    public function createPushImageCommand(Tag $tag);
}
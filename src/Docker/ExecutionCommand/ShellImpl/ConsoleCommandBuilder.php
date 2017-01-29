<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 17:40
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl;


use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IBuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\ICommandBuilder;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IPushImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\PushImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\BuildImageCommand;
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
        return new BuildImageCommand($dockerfile, $workingDirectory, $tags);
    }

    /**
     * Create push command
     *
     * @param Tag $tag
     * @return IPushImageCommand
     */
    public function createPushImageCommand(Tag $tag)
    {
        return new PushImageCommand($tag);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 17:40
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand;


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
     */
    public function createBuildImageCommand($dockerfile, $workingDirectory, array $tags)
    {

    }

    /**
     * Create push command
     *
     * @param Tag[] $tags
     */
    public function createPushImageCommand(array $tags)
    {

    }

}
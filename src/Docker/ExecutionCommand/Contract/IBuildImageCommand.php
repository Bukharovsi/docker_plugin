<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 17:45
 */
namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract;

use Bukharovsi\DockerPlugin\Docker\Image\Tag;

/**
 * Interface IBuildImageCommand
 *
 * Contract for Docker build image command
 *
 */
interface IBuildImageCommand extends IExecutable
{
    /**
     * BuildImageCommand constructor.
     * @param string $dockerfile
     * @param Tag[] $tags
     * @param string $workingDirectory
     */
    public function __construct($dockerfile, $workingDirectory, array $tags);

    /**
     * Run image building
     * @return null
     */
    public function execute();
}
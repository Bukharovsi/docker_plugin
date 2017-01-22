<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 17:45
 */
namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand;

use Bukharovsi\DockerPlugin\Docker\Image\Tag;

interface IBuildImageCommand extends IExecutable
{
    /**
     * BuildImageCommand constructor.
     * @param string $dockerfile
     * @param Tag $tags
     * @param string $workingDirectory
     */
    public function __construct($dockerfile, $workingDirectory, array $tags);

    public function execute();
}
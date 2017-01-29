<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 0:06
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand;


use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Exceptions\ExecutionCommandException;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;

/**
 * Class BuildImageCommand
 *
 * Build dockerimage
 *
 * @package Bukharovsi\DockerPlugin\Docker\ExecutionCommand
 */
class BuildImageCommand implements IExecutable, IBuildImageCommand
{
    /**
     * @var string
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
     * BuildImageCommand constructor.
     * @param string $dockerfile
     * @param Tag[] $tags
     * @param string $workingDirectory
     */
    public function __construct($dockerfile, $workingDirectory, array $tags)
    {
        $this->dockerfile = $dockerfile;
        $this->tags = $tags;
        $this->workingDirectory = $workingDirectory;
    }

    public function execute()
    {
        $cmd = $this->buildCommand();

        exec($cmd, $output, $returnVar);

        $returnVar = 0;
        if (0 != $returnVar) {
            throw ExecutionCommandException::buildCommandReturnsNotZeroCode($cmd, $output, $returnVar);
        }
    }

    /**
     * @return string
     */
    private function buildCommand()
    {
        $cmd = "docker build";
        foreach ($this->tags as $tag) {
            $cmd .= " -t $tag";
        }
        $cmd .= ' -f '. $this->dockerfile;
        $cmd .= ' ' . $this->workingDirectory;
        return $cmd;
    }


}
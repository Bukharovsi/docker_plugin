<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 0:06
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl;


use AdamBrett\ShellWrapper\Command;
use AdamBrett\ShellWrapper\Runners\Runner;
use AdamBrett\ShellWrapper\Runners\RunnerWithStandardOut;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IBuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IExecutable;
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
     * @var RunnerWithStandardOut;
     */
    private $runner;

    /**
     * BuildImageCommand constructor.
     * @param RunnerWithStandardOut $runner
     * @param string $dockerfile
     * @param string $workingDirectory
     * @param Tag[] $tags
     */
    public function __construct(RunnerWithStandardOut $runner, $dockerfile, $workingDirectory, array $tags)
    {
        $this->runner = $runner;
        $this->dockerfile = $dockerfile;
        $this->tags = $tags;
        $this->workingDirectory = $workingDirectory;
    }

    public function execute()
    {
        $cmd = $this->buildCommand();

        $exitCode = $this->runner->run(new Command($cmd));

        if (0 != $exitCode) {
            throw ExecutionCommandException::buildCommandReturnsNotZeroCode(
                $cmd, $this->runner->getStandardOut(), $exitCode
            );
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
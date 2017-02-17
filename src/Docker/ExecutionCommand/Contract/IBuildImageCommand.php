<?php

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract;

use AdamBrett\ShellWrapper\Runners\RunnerWithStandardOut;
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
     * @param RunnerWithStandardOut $runner
     * @param string $dockerfile
     * @param string $workingDirectory
     * @param Tag[] $tags
     */
    public function __construct(RunnerWithStandardOut $runner, $dockerfile, $workingDirectory, array $tags);

    /**
     * Run image building
     * @return null
     */
    public function execute();
}
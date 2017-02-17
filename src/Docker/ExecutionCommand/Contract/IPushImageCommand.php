<?php

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract;

use AdamBrett\ShellWrapper\Runners\RunnerWithStandardOut;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;


/**
 * Defines contract for docker push command
 *
 * It needs image tags
 */
interface IPushImageCommand extends IExecutable
{
    /**
     * PushImageCommand constructor.
     * @param RunnerWithStandardOut $runner
     * @param Tag $tag
     */
    public function __construct(RunnerWithStandardOut $runner, Tag $tag);

    /**
     * run doker push command
     *
     * @return void
     */
    public function execute();
}
<?php

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract;

use AdamBrett\ShellWrapper\Runners\ReturnValue;
use AdamBrett\ShellWrapper\Runners\Runner;
use AdamBrett\ShellWrapper\Runners\StandardOut;
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
     * @param Runner|ReturnValue|StandardOut $runner
     * @param Tag $tag
     */
    public function __construct(Runner $runner, Tag $tag);

    /**
     * run doker push command
     *
     * @return void
     */
    public function execute();
}
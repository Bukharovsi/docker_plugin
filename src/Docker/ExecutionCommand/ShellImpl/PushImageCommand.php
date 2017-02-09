<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 0:08
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl;


use AdamBrett\ShellWrapper\Command;
use AdamBrett\ShellWrapper\Runners\Runner;
use AdamBrett\ShellWrapper\Runners\RunnerWithStandardOut;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IPushImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Exceptions\ExecutionCommandException;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;

/**
 * Class PushImageCommand
 * @package Bukharovsi\DockerPlugin\Docker\ExecutionCommand
 */
class PushImageCommand implements IPushImageCommand
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * @var RunnerWithStandardOut
     */
    private $runner;

    /**
     * PushImageCommand constructor.
     * @param RunnerWithStandardOut $runner command runner
     * @param Tag|Tag[] $tag
     */
    public function __construct(RunnerWithStandardOut $runner, Tag $tag)
    {
        $this->runner = $runner;
        $this->tag = $tag;
    }

    public function execute()
    {
        $cmd = new Command('docker push');
        $cmd->addParam(new Command\Param($this->tag));

        $exitCode = $this->runner->run($cmd);

        if (0 != $exitCode || $this->runner->getReturnValue() !=0) {
            throw ExecutionCommandException::pushCommandReurnsNotZeroCode($cmd, $this->runner->getStandardOut(), $exitCode);
        }
    }


}
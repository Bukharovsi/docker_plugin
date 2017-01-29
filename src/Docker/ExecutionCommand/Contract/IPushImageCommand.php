<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 17:46
 */
namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\IExecutable;
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
     * @param Tag $tag
     */
    public function __construct(Tag $tag);

    /**
     * run doker push command
     *
     * @return void
     */
    public function execute();
}
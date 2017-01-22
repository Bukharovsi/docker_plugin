<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 17:46
 */
namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;


/**
 * Class PushImageCommand
 * @package Bukharovsi\DockerPlugin\Docker\ExecutionCommand
 */
interface IPushImageCommand extends IExecutable
{
    /**
     * PushImageCommand constructor.
     * @param Tag[] $tag
     */
    public function __construct(Tag $tag);

    public function execute();
}
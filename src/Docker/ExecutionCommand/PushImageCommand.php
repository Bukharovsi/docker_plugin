<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 0:08
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand;


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
     * PushImageCommand constructor.
     * @param Tag[] $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function execute()
    {
        $cmd = "docker push $this->tag";
        exec($cmd, $output, $returnCode);

        if (0 != $returnCode) {
            throw ExecutionCommandException::pushCommandReurnsNotZeroCode($cmd, $output, $returnCode);
        }
    }


}
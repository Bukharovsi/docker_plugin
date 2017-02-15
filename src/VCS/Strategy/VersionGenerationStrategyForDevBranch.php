<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.02.17
 * Time: 15:39
 */

namespace Bukharovsi\DockerPlugin\VCS\Strategy;


use Bukharovsi\DockerPlugin\Docker\Image\Tag;

class VersionGenerationStrategyForDevBranch implements IVersionGenerationStrategy
{

    public function versions()
    {
        return ['dev'];
    }

}
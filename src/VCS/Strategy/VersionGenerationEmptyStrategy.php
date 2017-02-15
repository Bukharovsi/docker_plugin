<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.02.17
 * Time: 15:33
 */

namespace Bukharovsi\DockerPlugin\VCS\Strategy;


class VersionGenerationEmptyStrategy implements IVersionGenerationStrategy
{
    public function versions()
    {
        return [];
    }

}
<?php

namespace Bukharovsi\DockerPlugin\Command;
use Composer\Plugin\Capability\CommandProvider;

/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 07.09.16
 * Time: 19:04
 */
class DockerCommandProvider implements CommandProvider
{
    public function getCommands()
    {
        return [new DockerBuildCommand()];
    }
}
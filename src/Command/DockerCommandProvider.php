<?php

namespace Bukharovsi\DockerPlugin\Command;

use Composer\Plugin\Capability\CommandProvider;

/**
 * Class DockerCommandProvider
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
class DockerCommandProvider implements CommandProvider
{
    public function getCommands()
    {
        return [new DockerBuildCommand()];
    }
}

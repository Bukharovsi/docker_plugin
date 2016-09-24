<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 11:59
 */

namespace Bukharovsi\DockerPlugin\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DockerPushCommand
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
class DockerPushCommand extends DockerCommands
{
    protected function getCommandName()
    {
        return 'docker:push';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $buildName = $input->getArguments()['buildName'];
        $dockerBuildConfig = $this->getDockerBuildConfig($buildName);
    }
}

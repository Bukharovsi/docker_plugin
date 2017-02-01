<?php
namespace Bukharovsi\DockerPlugin\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DockerBuildCommand
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
class DockerBuildCommand extends BaseDockerCommand
{
    /**
     * @return string
     */
    protected function getCommandName()
    {
        return 'docker:build';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->dockerImageApplication->buildDockerImage($input, $output);
    }
}
<?php

namespace Bukharovsi\DockerPlugin\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DockerPushCommand
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
class DockerPushCommand extends BaseDockerCommand
{
    protected function getCommandName()
    {
        return 'docker:push';
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->application->pushDockerImage($input);
    }
}

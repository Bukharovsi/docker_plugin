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
        $this->dockerImageApplication->pushDockerImage($input);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 11:59
 */

namespace Bukharovsi\DockerPlugin\Command;

use Bukharovsi\DockerPlugin\Docker\DockerCommandPush;
use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
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
        $dockerConfig = $this->getDockerConfig($input);

        $dockerPushCommand = new DockerCommandPush();
        $dockerPushCommand->setImageName($dockerConfig->getImageName());
        $command = $dockerPushCommand->buildCommand();

        $exitCode = null;
        $execOutput = [];
        exec($command, $execOutput, $exitCode);

        if (0 !== $exitCode) {
            throw DockerExecutionException::commandIsExecutedWithError($command, $exitCode);
        }

        $output->writeln('docker image has \"'.$dockerConfig->getImageTag() .'\"  successfully pushed');
        $output->writeln('docker command was executed: ' . $command);
    }
}

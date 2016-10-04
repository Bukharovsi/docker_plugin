<?php
namespace Bukharovsi\DockerPlugin\Command;

use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\DockerCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Tag\Tag;
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
        $dockerConfig = $this->getDockerConfig($input);

        $commandBuilder = new DockerCommandBuilder();
        $commandBuilder->addTag(new Tag(
            $dockerConfig->getImageName(),
            $dockerConfig->getImageTag()
        ));

        if ($dockerConfig->getDockerfile()) {
            $commandBuilder->specifyDockerfile($dockerConfig->getDockerfile());
        }
        if ($dockerConfig->getWorkingDirectory()) {
            $commandBuilder->specifyWorkingDirectory($dockerConfig->getWorkingDirectory());
        }

        $command = $commandBuilder->buildCommand();

        $exitCode = null;
        $execOutput = [];
        exec($command, $execOutput, $exitCode);

        if (0 !== $exitCode) {
            throw DockerExecutionException::commandIsExecutedWithError($command, $exitCode);
        }

        $output->writeln("docker image has successfully built");
    }
}
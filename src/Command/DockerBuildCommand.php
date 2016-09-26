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
class DockerBuildCommand extends DockerCommands
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
        $dockerBuildConfig = $this->getDockerConfig($input);

        $commandBuilder = new DockerCommandBuilder();
        $commandBuilder->addTag(new Tag(
            $dockerBuildConfig->getImageName(),
            $dockerBuildConfig->getImageTag()
        ));

        if ($dockerBuildConfig->getDockerfile()) {
            $commandBuilder->specifyDockerfile($dockerBuildConfig->getDockerfile());
        }
        if ($dockerBuildConfig->getWorkingDirectory()) {
            $commandBuilder->specifyWorkingDirectory($dockerBuildConfig->getWorkingDirectory());
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
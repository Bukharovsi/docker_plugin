<?php
namespace Bukharovsi\DockerPlugin\Command;

use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\DockerCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Tag\Tag;
use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
        $dockerBuildConfig = $this->getDockerBuildConfig($input);

        $name = $this->getImageName($dockerBuildConfig);
        $version = $this->getImageVersion($dockerBuildConfig);

        $commandBuilder = new DockerCommandBuilder();
        $commandBuilder->addTag(new Tag($name, $version));

        if (array_key_exists('dockerfile', $dockerBuildConfig)) {
            $commandBuilder->specifyDockerfile($dockerBuildConfig['dockerfile']);
        }

        if (array_key_exists('workingDirectory', $dockerBuildConfig)) {
            $commandBuilder->specifyWorkingDirectory($dockerBuildConfig['workingDirectory']);
        }

        $command = $commandBuilder->buildCommand();
//        $output->writeln('executing command is "'.$command.'"', OutputInterface::VERBOSITY_VERBOSE);

        $exitCode = null;
        $execOutput = [];
        exec($command, $execOutput, $exitCode);

        if (0 !== $exitCode) {
            throw DockerExecutionException::commandIsExecutedWithError($command, $exitCode);
        }

        $output->writeln("docker image has successfully built");
    }
}
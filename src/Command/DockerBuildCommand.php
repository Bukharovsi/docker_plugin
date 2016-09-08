<?php

namespace Bukharovsi\DockerPlugin\Command;


use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\DockerCommandBuilder;
use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DockerBuildCommand extends BaseCommand
{

    /**
     * @var DockerCommandBuilder
     */
    private $dockerCommandBuilder;

    protected function configure()
    {
        $this->setName('docker:build');
        $this->dockerCommandBuilder = new DockerCommandBuilder();
        parent::configure();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->getComposer()->getPackage()->getFullPrettyVersion());


        $command = $this->dockerCommandBuilder->buildCommand();
        $output->writeln('executing command is "'.$command.'"', OutputInterface::VERBOSITY_VERBOSE);

        $exitCode = null;
        $execOutput = [];
//        exec($command, $execOutput, $exitCode);


        if (0 !== $exitCode) {
            throw DockerExecutionException::commandIsExecutedWithError($command, $exitCode);
        }

        $output->writeln("processing docker build");
    }




}
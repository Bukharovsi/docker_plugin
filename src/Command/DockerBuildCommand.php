<?php

namespace Bukharovsi\DockerPlugin\Command;


use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Composer\Command\BaseCommand;
use Composer\Util\Filesystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DockerBuildCommand extends BaseCommand
{
    protected function configure()
    {
        $this->setName('docker:build');
        parent::configure();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->getComposer()->getPackage()->getFullPrettyVersion());
        $output->writeln("Project Root Directory is " . $this->getProjectRootPath(), OutputInterface::VERBOSITY_VERBOSE);



        $command = $this->createExecutableCommand();
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
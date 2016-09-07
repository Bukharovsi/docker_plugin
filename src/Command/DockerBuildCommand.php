<?php

namespace Bukharovsi\DockerPlugin\Command;


use Composer\Command\BaseCommand;
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
        $output->writeln("processing docker build");
    }

}
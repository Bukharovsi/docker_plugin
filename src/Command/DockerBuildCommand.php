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

class DockerBuildCommand extends BaseCommand
{


    protected function configure()
    {
        $this->setName('docker:build');
        $this->addArgument('build name', InputArgument::OPTIONAL, 'Name of the docker build. If not present use "default" value', 'default');
        $this->addOption('tag', 't', InputOption::VALUE_OPTIONAL, "Set the tag of image");
        parent::configure();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->getComposer()->getPackage()->getFullPrettyVersion());

        var_dump($input->getArguments());
        var_dump($input->getOptions());

        $buildName = 'default';

        $extra = $this->getComposer()->getPackage()->getExtra();
        if (!array_key_exists('docker', $extra)) {
            $output->writeln("There are no \"docker\" section into composer.json", OutputInterface::VERBOSITY_NORMAL);
            return;
        }
        $dockerBuilds =  $extra['docker'];


        $commandBuilder = new DockerCommandBuilder();

        if (! array_key_exists($buildName, $dockerBuilds)) {
            echo "build section not present";
            return;
        }

        $dockerBuildConfig = $dockerBuilds[$buildName];

        $name = $this->getComposer()->getPackage()->getPrettyName();
        if (array_key_exists('name', $dockerBuildConfig)) {
            $name = $dockerBuildConfig['name'];
        }
        $version = 'latest';
        if (array_key_exists('version', $dockerBuildConfig)){
            $version = $dockerBuildConfig['version'];
        }
        $commandBuilder->addTag(new Tag($name, $version));

        if (array_key_exists('dockerfile', $dockerBuildConfig)){
            $commandBuilder->specifyDockerfile($dockerBuildConfig['dockerfile']);
        }

        if (array_key_exists('workingDirectory', $dockerBuildConfig)){
            $commandBuilder->specifyWorkingDirectory($dockerBuildConfig['workingDirectory']);
        }


        $command = $commandBuilder->buildCommand();


        $output->writeln('executing command is "'.$command.'"', OutputInterface::VERBOSITY_VERBOSE);

        $exitCode = null;
        $execOutput = [];
//        exec($command, $execOutput, $exitCode);


        if (0 !== $exitCode) {
            throw DockerExecutionException::commandIsExecutedWithError($command, $exitCode);
        }

        $output->writeln("docker image has successfully built");
    }




}
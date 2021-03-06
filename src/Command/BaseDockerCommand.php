<?php

namespace Bukharovsi\DockerPlugin\Command;

use Bukharovsi\DockerPlugin\DI\DefaultDI;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BaseDockerCommand
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
abstract class BaseDockerCommand extends BaseCommand
{

    /**
     * @var DockerImageBuilderApplication;
     */
    protected $application;


    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $dic = new DefaultDI();
        $this->application = $dic->application($this->getComposer()->getPackage());
    }


    /**
     * Return command name
     *
     * @return string
     */
    abstract protected function getCommandName();

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $commandName = $this->getCommandName();
        $this->setName($commandName);
        $this->setDefinition(ConsoleInputConfiguration::createInputDefinition());

        parent::configure();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 12:26
 */

namespace Bukharovsi\DockerPlugin\Command;

use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\Config\DockerConfig;
use Bukharovsi\DockerPlugin\Docker\DockerConfigBuilder;
use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BaseDockerCommand
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
abstract class BaseDockerCommand extends BaseCommand
{
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
        $this->addArgument(
            'buildName',
            InputArgument::OPTIONAL,
            'Name of the docker build. If not present use "default" value',
            'default'
        );
        $this->addOption('tag', 't', InputOption::VALUE_OPTIONAL, "Set the tag of image");

        parent::configure();
    }

    /**
     * return docker params as object.
     * params merge from default settings, command line
     * and configuration json file
     *
     * @param InputInterface $input
     *
     * @throws DockerExecutionException
     * @return DockerConfig
     */
    protected function getDockerConfig(InputInterface $input)
    {
        $dockerConfigBuilder = new DockerConfigBuilder(
            $input,
            $this->getComposer()->getPackage()
        );

        return $dockerConfigBuilder->buildDockerConfig();
    }
}

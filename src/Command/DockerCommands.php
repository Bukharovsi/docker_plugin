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
 * Class DockerCommands
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
abstract class DockerCommands extends BaseCommand
{
    /**
     * @var DockerConfig
     */
    protected $dockerConfig;

    /**
     * Return command name
     *
     * @return string
     */
    abstract protected function getCommandName();

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
     * return params for docker
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

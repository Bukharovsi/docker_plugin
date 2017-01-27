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
use Bukharovsi\DockerPlugin\Docker\Configuration\ConsoleInputConfiguration;
use Bukharovsi\DockerPlugin\Docker\DockerConfigBuilder;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ConsoleCommandBuilder;
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
     * @var DockerImageBuilderApplication;
     */
    protected $dockerImageApplication;



    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $this->dockerImageApplication = new DockerImageBuilderApplication(
            $this->getComposer(true, true)->getPackage(),
            new ConsoleCommandBuilder()
        );
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

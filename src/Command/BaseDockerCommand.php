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
use Bukharovsi\DockerPlugin\Docker\Configuration\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\Configuration\ConsoleInputConfiguration;
use Bukharovsi\DockerPlugin\Docker\DockerConfigBuilder;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Docker\Report\FilteredByConfigurationReports;
use Bukharovsi\DockerPlugin\Docker\Report\ReportFullCollection;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityBuiltImageVersionReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
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

        // reports bean construction
        $registeredReports = new ReportFullCollection();
        $registeredReports->register('console', new LogOutputReport());
        $registeredReports->register('teamcity', new TeamcityBuiltImageVersionReport(new TeamcityVariableCollection()));

        //report collection bean construction
//        $reportApp = new ReportFullCollection($registeredReports, $configuratation);

        // configurator bean construction
        $configuratator = new ComposerProjectConfigurator($this->getComposer(true, true)->getPackage());

        // bean construction
        $this->dockerImageApplication = new DockerImageBuilderApplication(
            new ConsoleCommandBuilder(),
            $configuratator,
            $registeredReports
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

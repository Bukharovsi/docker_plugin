<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 29.01.17
 * Time: 13:28
 */

namespace Bukharovsi\DockerPlugin\DI;


use AdamBrett\ShellWrapper\Runners\Exec;
use AdamBrett\ShellWrapper\Runners\RunnerWithStandardOut;
use AdamBrett\ShellWrapper\Runners\ShellExec;
use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfigurator;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\ICommandBuilder;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Report\IMutableReportCollection;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Docker\Report\ReportFullCollection;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityBuiltImageVersionReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
use Composer\Package\RootPackageInterface;

/**
 * Class DefaultDI
 *
 * Stupid Di container for IOC
 *
 * If you want create another DockerImageBuilderApplication you can override this class
 * or make new one by IDIContainer
 *
 * @package Bukharovsi\DockerPlugin\DI
 */
class DefaultDI implements IDIContainer
{
    /**
     * @param RootPackageInterface $package
     * @return DockerImageBuilderApplication
     */
    public function application(RootPackageInterface $package)
    {
        $dockerImageApplication = new DockerImageBuilderApplication(
            $this->commandBuilder(),
            $this->configurator($package),
            $this->reports()
        );

        return $dockerImageApplication;
    }

    /**
     * Return registered reports collection
     *
     * @return IMutableReportCollection
     */
    public function reports()
    {
        $registeredReports = new ReportFullCollection();
        $registeredReports->register('console', new LogOutputReport());
        $registeredReports->register('teamcity', new TeamcityBuiltImageVersionReport(new TeamcityVariableCollection()));

        return $registeredReports;
    }

    /**
     * @param RootPackageInterface $package
     *
     * @return IConfigurator
     */
    public function configurator(RootPackageInterface $package)
    {
        $configuratator = new ComposerProjectConfigurator($package);

        return $configuratator;
    }

    /**
     * @return ICommandBuilder
     */
    public function commandBuilder()
    {
        return new ConsoleCommandBuilder($this->commandRunner());
    }

    /**
     * @return RunnerWithStandardOut
     */
    public function commandRunner()
    {
        return new Exec();
    }


}
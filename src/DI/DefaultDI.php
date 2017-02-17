<?php

namespace Bukharovsi\DockerPlugin\DI;


use AdamBrett\ShellWrapper\Runners\Exec;
use AdamBrett\ShellWrapper\Runners\RunnerWithStandardOut;
use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfigurator;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\ICommandBuilder;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Report\Html\HTMLReport;
use Bukharovsi\DockerPlugin\Docker\Report\IMutableReportCollection;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Docker\Report\PrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\ReportFullCollection;
use Bukharovsi\DockerPlugin\Docker\Report\SavableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityBuiltImageVersionReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\AlwaysTrueStrategy;
use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\InStrategy;
use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\IsEqualsStrategy;
use Bukharovsi\DockerPlugin\VCS\Configuration\VCSConfiguratorDecorator;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForDevBranch;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForFeatureBranch;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForMasterBranch;
use Bukharovsi\DockerPlugin\VCS\VCSVersioningStrategy;
use Composer\Package\RootPackageInterface;
use GitElephant\Repository;
use League\Plates\Engine;

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
        $registeredReports = new ReportFullCollection([
            'console' => new PrintableReport(new LogOutputReport()),
            'teamcity' => new PrintableReport(
                new TeamcityBuiltImageVersionReport(
                    new TeamcityVariableCollection()
                )
            ),
            'index' => new SavableReport(
                new HTMLReport(new Engine(HTMLReport::$REPORT_TEMPLATE_PATH))
            )
        ]);

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

        $gitRepository = new Repository(getcwd());
        $versioningStrategy = new VCSVersioningStrategy(
            $gitRepository,
            [
                new IsEqualsStrategy('master', VersionGenerationStrategyForMasterBranch::createWithSlaveTagStrategy($gitRepository)),
                new InStrategy(['dev', 'develop', 'development'], new VersionGenerationStrategyForDevBranch()),
                new AlwaysTrueStrategy(new VersionGenerationStrategyForFeatureBranch($gitRepository))
            ]
        );
        $configuratator = new VCSConfiguratorDecorator($configuratator, $versioningStrategy);

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
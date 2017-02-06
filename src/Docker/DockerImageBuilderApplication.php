<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 17:42
 */

namespace Bukharovsi\DockerPlugin\Docker;
use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfigurator;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract\ICommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Image\DockerImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableAndSavableReport;
use Bukharovsi\DockerPlugin\Docker\Report\FilteredByConfigurationReports;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DockerImageBuilderApplication
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerImageBuilderApplication
{
    /**
     * @var ICommandBuilder
     */
    private $commandBuilder;

    /**
     * @var IPrintableAndSavableReport
     */
    private $reportCollection;

    /**
     * @var IConfigurator
     */
    private $configurator;

    /**
     * DockerImageBuilderApplication constructor.
     *
     * @param ICommandBuilder $commandBuilder
     * @param IConfigurator $configurator
     * @param IPrintableAndSavableReport|IReport $reports
     *
     * @internal param IConfigurator $configurator
     */
    public function __construct(
        ICommandBuilder $commandBuilder,
        IConfigurator $configurator,
        IPrintableAndSavableReport $reports
    )
    {
        $this->commandBuilder = $commandBuilder;
        $this->configurator = $configurator;
        $this->reportCollection = $reports;
    }

    public function buildDockerImage(InputInterface $input, OutputInterface $output)
    {
        $configuraton = $this->configurator->makeConfiguration($input);
        $image = new DockerImage($configuraton, $this->commandBuilder);
        $builtImage = $image->build();
        $this->reportCollection->make($builtImage, $output, $configuraton->outputReportPath());
    }

    public function pushDockerImage(InputInterface $input)
    {
        $configuraton = $this->configurator->makeConfiguration($input);
        $image = new DockerImage($configuraton, $this->commandBuilder);
        $image->push();
    }
    
}
<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 28.01.17
 * Time: 21:16
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;

use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IReportConfiguration;
use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\OutputInterface;

class FilteredByConfigurationReports implements IReport
{

    /**
     * @var ReportFullCollection
     */
    private $registeredReports;

    private $reportConfiguration;

    /**
     * ReportApplication constructor.
     * @param ReportFullCollection $registeredReports
     * @param IReportConfiguration $reportConfiguration
     */
    public function __construct(ReportFullCollection $registeredReports, IReportConfiguration $reportConfiguration)
    {
        $this->registeredReports = $registeredReports;
        $this->reportConfiguration = $registeredReports;
    }

    public function make(BuiltImage $builtImage, OutputInterface $output)
    {
        //todo add filtration by configuration
        $this->registeredReports->make($builtImage, $output);
    }
}
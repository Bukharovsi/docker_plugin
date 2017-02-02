<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 28.01.17
 * Time: 20:59
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableAndSavableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\ISavableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Exception\NotSupportableReportException;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ReportFullCollection
 *
 * Collection of registered Reports
 *
 * @package Bukharovsi\DockerPlugin\Docker\Report
 */
class ReportFullCollection implements IPrintableAndSavableReport
{
    /**
     * @var IPrintableReport[]|ISavableReport[]|IReport[]
     */
    private $registeredReports = [];

    /**
     * @var string[]
     */
    private $mustBeExecuted;

    /**
     * ReportFullCollection constructor.
     * @param IReport[] $registeredReports
     */
    public function __construct(array $registeredReports = [])
    {
        $this->registeredReports = $registeredReports;
    }

    public function markAllAsExecutable()
    {

    }

    public function add($reportName)
    {

    }

    public function reject($reportName)
    {
        // TODO: Implement reject() method.
    }


    /**
     * Make a reports
     *
     * @param BuiltImage $builtImage
     * @param OutputInterface $output
     * @param $outputDirectory
     * @return null
     * @throws NotSupportableReportException
     */
    public function make(BuiltImage $builtImage, OutputInterface $output, $outputDirectory)
    {
        foreach ($this->registeredReports as $reportName => $report) {
            if ($report instanceof IPrintableReport) {
                $report->make($builtImage, $output);
            } elseif ($report instanceof ISavableReport) {
                $report->make($builtImage, $outputDirectory, $reportName);
            }elseif ($report instanceof IReport) {
                $report->make($builtImage);
            }elseif ($report instanceof IPrintableAndSavableReport) {
                $report->make($builtImage, $output, $outputDirectory);
            } else {
                throw NotSupportableReportException::cantRunReport($report);
            }
            $report->make($builtImage, $output);
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 24.01.17
 * Time: 22:46
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Configuration\IReportConfiguration;
use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityBuiltImageVersionReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
use Symfony\Component\Console\Output\Output;

class ReportCollection implements IReport
{

    /**
     * @var IReport[]
     */
    private $registeredReports = [];

    /**
     * @var IReport[]
     */
    private $reportsToMake = [];

    /**
     * @var BuiltImage
     */
    private $builtImage;

    /**
     * @var Output
     */
    private $output;

    public function __construct(BuiltImage $builtImage, IReportConfiguration $conf, Output $output)
    {
        $this->constructDefaultReports($builtImage, $output);
        $this->builtImage = $builtImage;
        $this->output = $output;

        foreach ($conf->reports() as $reportName => $report) {
            if (array_key_exists($reportName, $this->registeredReports)) {
                $this->reportsToMake[$reportName] = $report;
            }
        }


    }

    public function make()
    {
        foreach ($this->reportsToMake as $report) {
            $report->make();
        }
    }

    /**
     * @param BuiltImage $builtImage
     * @param Output $output
     */
    private function constructDefaultReports(BuiltImage $builtImage, Output $output)
    {
        $this->registeredReports = [
            'console' => new SimpleOutputReport($builtImage, $output),
            'teamcity' => new TeamcityBuiltImageVersionReport($builtImage, $output, new TeamcityVariableCollection())
        ];
    }

}
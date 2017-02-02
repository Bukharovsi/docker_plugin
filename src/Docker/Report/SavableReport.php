<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 12:28
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\ISavableReport;

class SavableReport implements ISavableReport
{

    /** @var  IReport */
    private $report;

    /**
     * SavableHtmlReport constructor.
     * @param IReport $report
     */
    public function __construct(IReport $report)
    {
        $this->report = $report;
    }

    public function make(BuiltImage $builtImage, $outputDirectory, $reportName)
    {
        file_put_contents($outputDirectory.'/'.$reportName.'.html', $this->report->make($builtImage));
    }


}
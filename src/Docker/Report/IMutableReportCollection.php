<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 29.01.17
 * Time: 13:32
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;

interface IMutableReportCollection extends IPrintableReport
{
    public function add($reportName);

    public function reject($reportName);
}
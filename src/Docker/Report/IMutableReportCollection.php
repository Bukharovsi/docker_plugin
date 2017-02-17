<?php

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;

interface IMutableReportCollection extends IPrintableReport
{
    public function add($reportName);

    public function reject($reportName);
}
<?php

namespace Bukharovsi\DockerPlugin\Docker\Report;

use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableReport;

interface IMutableReportCollection extends IPrintableReport
{
    public function add($reportName);

    public function reject($reportName);
}

<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 29.01.17
 * Time: 13:32
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


interface IMutableReportCollection extends IReport
{
    public function add($reportName);

    public function reject($reportName);
}
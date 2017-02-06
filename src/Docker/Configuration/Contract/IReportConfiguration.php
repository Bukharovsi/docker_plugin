<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 27.01.17
 * Time: 1:04
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Contract;


interface IReportConfiguration
{
    public function reports();

    public function outputReportPath();
}
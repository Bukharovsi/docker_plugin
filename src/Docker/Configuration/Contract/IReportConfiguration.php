<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Contract;

interface IReportConfiguration
{
    public function reports();

    public function outputReportPath();
}

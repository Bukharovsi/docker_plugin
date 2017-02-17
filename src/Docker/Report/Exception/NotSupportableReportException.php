<?php

namespace Bukharovsi\DockerPlugin\Docker\Report\Exception;

use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableAndSavableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\ISavableReport;

class NotSupportableReportException extends \Exception
{
    public static function cantRunReport($report)
    {
        return new static(
            sprintf(
                "Report %s not supported. Report must implement one of interfaces %s"
            ),
                get_class($report),
                implode(', ', [
                    IReport::class,
                    IPrintableReport::class,
                    ISavableReport::class,
                    IPrintableAndSavableReport::class
                ])
            );
    }
}

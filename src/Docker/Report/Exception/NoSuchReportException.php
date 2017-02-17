<?php

namespace Bukharovsi\DockerPlugin\Docker\Report\Exception;

class NoSuchReportException extends \Exception
{
    public static function reportNotFound($alias, array $registeredReportsNames)
    {
        return new static(
            sprintf(
                "No report %s register. Registered reports are: ",
                $alias,
                implode(', ', $registeredReportsNames)
            )
        );
    }
}

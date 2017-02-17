<?php

namespace Bukharovsi\DockerPlugin\Docker\Report\Exception;

class NoSuchReportException extends \Exception
{
    /**
     * @param string $alias
     * @param string[] $registeredReports registered report names
     * @return static
     */
    public static function reportNotFound($alias, array $registeredReports)
    {
        return new static(
            sprintf(
                "No report %s register. Registered reports are: ",
                $alias,
                implode(', ', $registeredReports)
            )
        );
    }
}

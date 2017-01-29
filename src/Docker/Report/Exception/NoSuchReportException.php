<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 28.01.17
 * Time: 21:06
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Exception;


class NoSuchReportException extends \Exception
{
    public static function reportNotFound($alias, array $registeredReportsNames)
    {
        return new static(
            sprintf("No report %s register. Registered reports are: ",
                $alias,
                implode(', ', $registeredReportsNames)
            )
        );
    }
}
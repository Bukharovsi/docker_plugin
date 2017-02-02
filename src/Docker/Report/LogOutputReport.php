<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 24.01.17
 * Time: 22:05
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LogOutputReport
 * @package Bukharovsi\DockerPlugin\Docker\Report
 */
class LogOutputReport implements IReport
{
    /**
     * @param BuiltImage $builtImage
     * @return string
     */
    public function make(BuiltImage $builtImage)
    {
        $report = '';
        foreach ($builtImage->tags() as $tag) {
            $report.="Image with tag $tag has been created\n";
        }

        return $report;
    }


}
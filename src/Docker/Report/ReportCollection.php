<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 24.01.17
 * Time: 22:46
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Configuration\IConfiguration;
use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\Output;

class ReportCollection implements IReport
{
    public function __construct(BuiltImage $builtImage, IConfiguration $conf, Output $output)
    {
    }

    public function make()
    {

    }

}
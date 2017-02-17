<?php

namespace Bukharovsi\DockerPlugin\Docker\Report\Contract;

use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface IReport
 *
 * @package Bukharovsi\DockerPlugin\Docker\Report
 */
interface IReport
{

    public function make(BuiltImage $builtImage);
}
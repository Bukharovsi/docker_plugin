<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 12:33
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Contract;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\OutputInterface;

interface IPrintableReport
{
    public function make(BuiltImage $image, OutputInterface $output);
}
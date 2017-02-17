<?php

namespace Bukharovsi\DockerPlugin\Docker\Report\Contract;

use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\OutputInterface;

interface IPrintableAndSavableReport
{
    public function make(BuiltImage $builtImage, OutputInterface $output, $outputDirectory);
}
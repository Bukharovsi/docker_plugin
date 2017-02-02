<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 12:33
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Contract;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;

interface ISavableReport
{

    /**
     * @param BuiltImage $builtImage
     * @param string $outputDirectory
     * @return void
     */
    public function make(BuiltImage $builtImage, $outputDirectory, $reportName);
}
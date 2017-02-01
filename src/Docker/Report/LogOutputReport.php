<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 24.01.17
 * Time: 22:05
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LogOutputReport
 * @package Bukharovsi\DockerPlugin\Docker\Report
 */
class LogOutputReport implements IReport
{
    /**
     * @param BuiltImage $builtImage
     * @param OutputInterface $output
     */
    public function make(BuiltImage $builtImage, OutputInterface $output)
    {
        foreach ($builtImage->tags() as $tag) {
            $output->writeln("Image with tag $tag has been created\n");
        }
    }


}
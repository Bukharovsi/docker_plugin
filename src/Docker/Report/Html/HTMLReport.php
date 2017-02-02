<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 11:41
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Html;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use Symfony\Component\Console\Output\OutputInterface;

class HTMLReport implements IReport
{
    /**
     * @var PrintableImage;
     */
    private $printableImage;

    /**
     * @param BuiltImage $builtImage
     * @param OutputInterface $output
     * @return string
     */
    public function make(BuiltImage $builtImage, OutputInterface $output)
    {
        $this->printableImage = new PrintableImage($builtImage);

        $report = '<div class="docker-html-report">';
        $report .= $this->printableImage->__toString();
        $report .='</div>';

        return $report;
    }



}
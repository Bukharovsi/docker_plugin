<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 12:35
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IPrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use Symfony\Component\Console\Output\OutputInterface;

class PrintableReport implements IPrintableReport
{

    /**
     * @var IReport
     */
    private $report;

    /**
     * PrintableReport constructor.
     * @param IReport $report
     */
    public function __construct(IReport $report)
    {
        $this->report = $report;
    }


    public function make(BuiltImage $builtImage, OutputInterface $output)
    {
        $output->writeln($this->report->make($builtImage));
    }
}
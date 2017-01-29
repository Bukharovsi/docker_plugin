<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 28.01.17
 * Time: 20:59
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ReportFullCollection
 *
 * Collection of registered Reports
 *
 * @package Bukharovsi\DockerPlugin\Docker\Report
 */
class ReportFullCollection implements IReport
{
    /**
     * @var IReport[]
     */
    private $registeredReports = [];

    /**
     * ReportFullCollection constructor.
     * @param IReport[] $registeredReports
     */
    public function __construct(array $registeredReports = [])
    {
        $this->registeredReports = $registeredReports;
    }

    /**
     * Register new report
     *
     * @param string $alias
     * @param IReport $report
     */
    public function register($alias, IReport $report)
    {
        $this->registeredReports[$alias] = $report;
    }

    /**
     * Make a reports
     *
     * @param BuiltImage $builtImage
     * @param OutputInterface $output
     * @return null
     */
    public function make(BuiltImage $builtImage, OutputInterface $output)
    {
        foreach ($this->registeredReports as $report) {
            $report->make($builtImage, $output);
        }
    }
}
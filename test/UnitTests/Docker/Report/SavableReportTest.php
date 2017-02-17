<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 16:08
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Docker\Report\SavableReport;

class SavableReportTest extends \PHPUnit_Framework_TestCase
{
    public function testSave()
    {
        $outputDir = '/tmp';

        $tag = new Tag('nginx');
        $builtImage = new BuiltImage([$tag]);
        $report = new LogOutputReport();
        $printableReport = new SavableReport($report);

        $printableReport->make($builtImage, $outputDir, 'htmlreport');

        static::assertFileExists($outputDir.'/htmlreport.html');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $testFile = '/tmp/htmlreport.html';
        if (file_exists($testFile)) {
            unlink($testFile);
        }
    }


}

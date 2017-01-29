<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 27.01.17
 * Time: 13:44
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Test\Docker\FakeObjects\FakeOutput;

class LogOutputReportTest extends \PHPUnit_Framework_TestCase
{
    public function testReport()
    {
        $tag1 = new Tag('nginx', '2.1');
        $tag2 =  new Tag('nginx', 'latest');
        $builtImage = new BuiltImage([$tag1, $tag2]);
        $output = new FakeOutput();
        $report = new LogOutputReport();

        $report->make($builtImage, $output);

        static::assertContains($tag1->__toString(), $output->output);
        static::assertContains($tag2->__toString(), $output->output);
    }
}

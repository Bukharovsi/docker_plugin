<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Report;

use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects\FakeOutput;

class LogOutputReportTest extends \PHPUnit_Framework_TestCase
{
    public function testReport()
    {
        $tag1 = new Tag('nginx', '2.1');
        $tag2 =  new Tag('nginx', 'latest');
        $builtImage = new BuiltImage([$tag1, $tag2]);
        $report = new LogOutputReport();

        $reportOutput = $report->make($builtImage);

        static::assertContains($tag1->__toString(), $reportOutput);
        static::assertContains($tag2->__toString(), $reportOutput);
    }
}

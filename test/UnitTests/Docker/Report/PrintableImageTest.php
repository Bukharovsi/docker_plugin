<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Report;

use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Docker\Report\PrintableReport;
use Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects\FakeOutput;

class PrintableImageTest extends \PHPUnit_Framework_TestCase
{
    public function testPrinting()
    {
        $tag = new Tag('nginx');
        $builtImage = new BuiltImage([$tag]);
        $report = new LogOutputReport();
        $printableReport = new PrintableReport($report);

        $output = new FakeOutput();
        $printableReport->make($builtImage, $output);

        static::assertContains($tag->__toString(), $output->output);
    }
}

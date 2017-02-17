<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 27.01.17
 * Time: 17:04
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\Docker\Report\ReportCollection;
use Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects\FakeOutput;

class ReportCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testReportCollection()
    {
        $tag1 = new Tag('nginx', '2.1');
        $tag2 =  new Tag('nginx', 'latest');
        $builtImage = new BuiltImage([$tag1, $tag2]);
        $output = new FakeOutput();

//        $collecrion = new ReportCollection()
    }
}

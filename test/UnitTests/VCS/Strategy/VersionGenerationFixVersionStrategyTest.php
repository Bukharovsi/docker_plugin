<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 15:27
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;


use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationFixVersionStrategy;

class VersionGenerationFixVersionStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testWorking()
    {
        $s = new VersionGenerationFixVersionStrategy(['latest']);

        static::assertEquals(['latest'], $s->versions());
    }
}

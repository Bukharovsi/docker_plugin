<?php

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

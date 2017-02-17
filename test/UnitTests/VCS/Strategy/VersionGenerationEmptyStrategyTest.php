<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;

use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationEmptyStrategy;

class VersionGenerationEmptyStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testEmpty()
    {
        $strategy = new VersionGenerationEmptyStrategy();
        static::assertEquals([], $strategy->versions());
    }
}

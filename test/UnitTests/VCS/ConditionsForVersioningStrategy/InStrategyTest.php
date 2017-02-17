<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\ConditionsForVersioningStrategy;

use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\InStrategy;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationFixVersionStrategy;

class InStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testMatches()
    {
        $s = new InStrategy(['dev', 'develop'], new VersionGenerationFixVersionStrategy(['latest']));
        static::assertTrue($s->isFit('dev'));
        static::assertEquals(['latest'], $s->versions());
    }

    public function testNotMatches()
    {
        $s = new InStrategy(['dev', 'develop'], new VersionGenerationFixVersionStrategy(['latest']));
        static::assertFalse($s->isFit('master'));
    }
}

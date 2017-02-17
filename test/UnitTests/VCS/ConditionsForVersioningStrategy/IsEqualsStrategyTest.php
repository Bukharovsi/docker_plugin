<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\ConditionsForVersioningStrategy;

use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\IsEqualsStrategy;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationFixVersionStrategy;

class IsEqualsStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testMatches()
    {
        $s = new IsEqualsStrategy('dev', new VersionGenerationFixVersionStrategy(['latest']));
        static::assertTrue($s->isFit('dev'));
        static::assertEquals(['latest'], $s->versions());
    }

    public function testNotMatches()
    {
        $s = new IsEqualsStrategy('dev', new VersionGenerationFixVersionStrategy(['latest']));
        static::assertFalse($s->isFit('master'));
    }
}

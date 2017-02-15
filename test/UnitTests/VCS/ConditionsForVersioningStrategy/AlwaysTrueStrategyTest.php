<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 15:23
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\ConditionsForVersioningStrategy;


use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\AlwaysTrueStrategy;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationFixVersionStrategy;

class AlwaysTrueStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testWorking()
    {
        $s = new AlwaysTrueStrategy(new VersionGenerationFixVersionStrategy(['latest']));
        static::assertTrue($s->isFit('any'));
        static::assertEquals(['latest'], $s->versions());
    }

}

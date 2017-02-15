<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 14:26
 */

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

<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;

use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForDevBranch;

class VersionGenerationStrategyForDevBranchTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingTags()
    {
        $strategy = new VersionGenerationStrategyForDevBranch();
        static::assertEquals(['dev'], $strategy->versions());
    }
}

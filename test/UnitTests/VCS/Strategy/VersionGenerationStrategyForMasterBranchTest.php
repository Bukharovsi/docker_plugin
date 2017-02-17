<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;

use Bukharovsi\DockerPlugin\Test\UnitTests\VCS\FakeObject\FakeRepositoryBuilder;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForMasterBranch;

class VersionGenerationStrategyForMasterBranchTest extends \PHPUnit_Framework_TestCase
{
    public function testWorkingWIthEmptyStrategy()
    {
        $strategy = new VersionGenerationStrategyForMasterBranch();
        static::assertEquals(['latest'], $strategy->versions());
    }

    public function testWorkingWithTagSlaveStrategy()
    {
        $strategy = VersionGenerationStrategyForMasterBranch::createWithSlaveTagStrategy(
            FakeRepositoryBuilder::withTags(['2.0'])
        );

        static::assertCount(2, $strategy->versions());
        static::assertContains('latest', $strategy->versions());
        static::assertContains('2.0', $strategy->versions());
    }
}

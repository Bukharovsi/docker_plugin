<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 14:13
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;


use Bukharovsi\DockerPlugin\Test\UnitTests\VCS\FakeObject\FakeRepositoryBuilder;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForFeatureBranch;

class VersionGenerationStrategyForFeatureBranchTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingVersion()
    {
        $strategy = new VersionGenerationStrategyForFeatureBranch(
            FakeRepositoryBuilder::withBranchAndCommit('my_cool_feature', 'fff')
        );

        static::assertCount(2, $strategy->versions());
        static::assertContains('my_cool_feature', $strategy->versions());
        static::assertContains('fff', $strategy->versions());
    }
}

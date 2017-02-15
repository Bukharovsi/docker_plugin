<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 15:35
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests;


use Bukharovsi\DockerPlugin\Test\UnitTests\VCS\FakeObject\FakeRepositoryBuilder;
use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\AlwaysTrueStrategy;
use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\InStrategy;
use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\IsEqualsStrategy;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForDevBranch;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForFeatureBranch;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForMasterBranch;
use Bukharovsi\DockerPlugin\VCS\VCSVersioningStrategy;

class VCSVersioningStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testWorkingForMaster()
    {
        $currentBranch = 'master';
        $currentSha = 'ffff';
        $strategy = $this->createDefaultStrategy($currentBranch, $currentSha);

        static::assertCount(2, $strategy->versions());
        static::assertContains('latest', $strategy->versions());
        static::assertContains('2.0', $strategy->versions());
    }

    public function testWorkingForDev()
    {
        $currentBranch = 'dev';
        $currentSha = 'ffff';
        $strategy = $this->createDefaultStrategy($currentBranch, $currentSha);

        static::assertCount(1, $strategy->versions());
        static::assertContains('dev', $strategy->versions());
    }

    public function testWorkingForFeatureBranch()
    {
        $currentBranch = 'my_coolFeature';
        $currentSha = 'ffff';
        $strategy = $this->createDefaultStrategy($currentBranch, $currentSha);

        static::assertCount(2, $strategy->versions());
        static::assertContains($currentBranch, $strategy->versions());
        static::assertContains($currentSha, $strategy->versions());
    }

    /**
     * @param $currentBranch
     * @param $currentSha
     * @return VCSVersioningStrategy
     */
    private function createDefaultStrategy($currentBranch, $currentSha)
    {
        $strategy = new VCSVersioningStrategy(FakeRepositoryBuilder::withBranchAndCommit($currentBranch, $currentSha),
            [
                new IsEqualsStrategy(
                    'master',
                    VersionGenerationStrategyForMasterBranch::createWithSlaveTagStrategy(
                        FakeRepositoryBuilder::withTags(['2.0'])
                    )
                ),
                new InStrategy(
                    ['dev', 'develop', 'development'],
                    new VersionGenerationStrategyForDevBranch()
                ),
                new AlwaysTrueStrategy(
                    new VersionGenerationStrategyForFeatureBranch(
                        FakeRepositoryBuilder::withBranchAndCommit($currentBranch, $currentSha)
                    )
                )
            ]
        );
        return $strategy;
    }
}

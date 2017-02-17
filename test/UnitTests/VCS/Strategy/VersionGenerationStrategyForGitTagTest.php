<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;

use Bukharovsi\DockerPlugin\Test\UnitTests\VCS\FakeObject\FakeRepositoryBuilder;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForGitTag;

class VersionGenerationStrategyForGitTagTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingTags()
    {

        $strategy = new VersionGenerationStrategyForGitTag(FakeRepositoryBuilder::withTags(['1.0']));
        static::assertEquals(['1.0'], $strategy->versions());
    }
}

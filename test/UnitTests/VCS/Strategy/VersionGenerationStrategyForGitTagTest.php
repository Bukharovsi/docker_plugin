<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 13:31
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;


use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\Test\UnitTests\VCS\FakeObject\FakeRepositoryBuilder;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForGitTag;
use GitElephant\Repository;

class VersionGenerationStrategyForGitTagTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingTags()
    {

        $strategy = new VersionGenerationStrategyForGitTag(FakeRepositoryBuilder::withTags(['1.0']));
        static::assertEquals(['1.0'], $strategy->versions());
    }
}

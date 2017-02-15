<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 13:32
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\Strategy;


use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForDevBranch;

class VersionGenerationStrategyForDevBranchTest extends \PHPUnit_Framework_TestCase
{
    public function testGettingTags()
    {
        $strategy = new VersionGenerationStrategyForDevBranch();
        static::assertEquals(['dev'], $strategy->versions());
    }
}

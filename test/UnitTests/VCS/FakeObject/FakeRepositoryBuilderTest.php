<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 14:07
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\FakeObject;


class FakeRepositoryBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testWithTags()
    {
        $rep = FakeRepositoryBuilder::withTags(['1.0']);

        static::assertEquals('1.0', $rep->getCommit()->getTags()[0]->getName());
    }

    public function testWithBranchAndSha()
    {
        $rep = FakeRepositoryBuilder::withBranchAndCommit('master', 'ffff');

        static::assertEquals('master', $rep->getMainBranch()->getName());
        static::assertEquals('ffff', $rep->getCommit()->getSha());
    }
}

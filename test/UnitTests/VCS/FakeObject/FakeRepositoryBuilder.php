<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 13:36
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\VCS\FakeObject;


use GitElephant\Objects\Branch;
use GitElephant\Objects\Commit;
use GitElephant\Objects\Tag;
use GitElephant\Repository;

class FakeRepositoryBuilder
{

    /**
     * @param array $tagsNames
     * @return Repository
     */
    public static function withTags(array $tagsNames)
    {
        $fakeTags = [];
        foreach ($tagsNames as $tagName) {
            $fakeTag = \Mockery::mock(Tag::class);
            $fakeTag->shouldReceive('getName')->andReturn($tagName);
            $fakeTags[] = $fakeTag;
        }


        $fakeCommit = \Mockery::mock(Commit::class);
        $fakeCommit->shouldReceive('getTags')->andReturn($fakeTags);

        $repository = \Mockery::mock(Repository::class);
        $repository->shouldReceive('getCommit')->andReturn($fakeCommit);

        return $repository;
    }

    /**
     * @param $branch
     * @param $sha
     * @return Repository
     */
    public static function withBranchAndCommit($branch, $sha)
    {
        $fakeCommit = \Mockery::mock(Commit::class);
        $fakeCommit->shouldReceive('getSha')->andReturn($sha);

        $fakeBranch = \Mockery::mock(Branch::class);
        $fakeBranch->shouldReceive('getName')->andReturn($branch);

        $repository = \Mockery::mock(Repository::class);
        $repository->shouldReceive('getCommit')->andReturn($fakeCommit);
        $repository->shouldReceive('getMainBranch')->andReturn($fakeBranch);

        return $repository;
    }

}
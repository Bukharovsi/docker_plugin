<?php

namespace Bukharovsi\DockerPlugin\VCS\Strategy;

use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use GitElephant\Repository;

class VersionGenerationStrategyForGitTag implements IVersionGenerationStrategy
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * VersionGenerationStrategyForMasterBranch constructor.
     * @param $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function versions()
    {
        $versions = [];
        foreach ($this->repository->getCommit()->getTags() as $gitTag) {
            $versions[] = $gitTag->getName();
        }

        return $versions;
    }


}
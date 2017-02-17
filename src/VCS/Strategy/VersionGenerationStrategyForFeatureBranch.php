<?php

namespace Bukharovsi\DockerPlugin\VCS\Strategy;

use GitElephant\Repository;

class VersionGenerationStrategyForFeatureBranch implements IVersionGenerationStrategy
{

    /**
     * @var Repository
     */
    private $repository;

    /**
     * VersionGenerationStrategyForFeatureBranch constructor.
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }


    public function versions()
    {
        return [
            $this->repository->getMainBranch()->getName(),
            $this->repository->getCommit()->getSha(true)
        ];
    }
}

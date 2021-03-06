<?php

namespace Bukharovsi\DockerPlugin\VCS;

use Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy\IVersionGenerationStrategyWithCondition;
use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;
use GitElephant\Repository;

class VCSVersioningStrategy implements IVersionGenerationStrategy
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var IVersionGenerationStrategyWithCondition[]
     */
    private $strategies;

    /**
     * VCSVersioningStrategy constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository, $strategies)
    {
        $this->repository = $repository;
        $this->strategies = $strategies;
    }

    public function versions()
    {
        $branch = $this->repository->getMainBranch()->getName();

        foreach ($this->strategies as $strategy) {
            if ($strategy->isFit($branch)) {
                return $strategy->versions();
            }
        }
    }
}

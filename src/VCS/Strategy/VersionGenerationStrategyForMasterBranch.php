<?php

namespace Bukharovsi\DockerPlugin\VCS\Strategy;

use GitElephant\Repository;

class VersionGenerationStrategyForMasterBranch implements IVersionGenerationStrategy
{
    /**
     * @var IVersionGenerationStrategy
     */
    private $slaveStrategy;

    public static function createWithSlaveTagStrategy(Repository $repository)
    {
        $strategy = new static(new VersionGenerationStrategyForGitTag($repository));
        return $strategy;
    }

    /**
     * VersionGenerationStrategyForMasterBranch constructor.
     * @param IVersionGenerationStrategy $slaveStrategy
     */
    public function __construct(IVersionGenerationStrategy $slaveStrategy = null)
    {
        if (null == $slaveStrategy) {
            $slaveStrategy = new VersionGenerationEmptyStrategy();
        }
        $this->slaveStrategy = $slaveStrategy;
    }

    public function versions()
    {
        $tags = $this->slaveStrategy->versions();
        $tags[] = 'latest';
        return $tags;
    }

}
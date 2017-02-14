<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.02.17
 * Time: 15:13
 */

namespace Bukharovsi\DockerPlugin\VCS\Strategy;


use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use GitElephant\Repository;

class VersionGenerationStrategyForMasterBranch implements IVersionGenerationStrategy
{

    /**
     * @var Repository
     */
    private $repository;

    private $slaveStrategy;

    public static function createWithSlaveTagStrategy(Repository $repository)
    {
        $strategy = new static($repository, new VersionGenerationStrategyForGitTag($repository));
        return $strategy;
    }

    /**
     * VersionGenerationStrategyForMasterBranch constructor.
     * @param Repository $repository
     * @param IVersionGenerationStrategy $slaveStrategy
     */
    public function __construct(Repository $repository, IVersionGenerationStrategy $slaveStrategy = null)
    {
        $this->repository = $repository;

        if (null == $slaveStrategy) {
            $slaveStrategy = new VersionGenerationEmptyStrategy();
        }
        $this->slaveStrategy = $slaveStrategy;
    }

    public function tags()
    {
        $tags = $this->slaveStrategy->tags();
        $tags[] = new Tag('latest');
        return $tags;
    }

}
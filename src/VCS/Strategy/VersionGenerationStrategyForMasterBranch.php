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
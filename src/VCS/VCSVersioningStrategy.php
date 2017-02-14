<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 23:58
 */

namespace Bukharovsi\DockerPlugin\VCS;


use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForDevBranch;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForFeatureBranch;
use Bukharovsi\DockerPlugin\VCS\Strategy\VersionGenerationStrategyForMasterBranch;
use GitElephant\Repository;

class VCSVersioningStrategy implements IVersionGenerationStrategy
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * VCSVersioningStrategy constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function tags()
    {
        $branch = $this->repository->getMainBranch();

        $strategy = null;
        switch (true) {
            case $branch == 'master' :
                $strategy = VersionGenerationStrategyForMasterBranch::createWithSlaveTagStrategy($this->repository);
                break;
            case in_array($branch, ['dev', 'develop', 'development']):
                $strategy = new VersionGenerationStrategyForDevBranch();
                break;
            default:
                $strategy = new VersionGenerationStrategyForFeatureBranch($this->repository);
        }

        return $strategy->tags();


    }
}
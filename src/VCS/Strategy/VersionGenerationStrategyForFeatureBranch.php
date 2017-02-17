<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.02.17
 * Time: 15:41
 */

namespace Bukharovsi\DockerPlugin\VCS\Strategy;


use Bukharovsi\DockerPlugin\Docker\Image\Tag;
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
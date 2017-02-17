<?php

namespace Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy;

use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;

class IsEqualsStrategy implements IVersionGenerationStrategyWithCondition
{
    private $branchName;

    /**
     * @var IVersionGenerationStrategy
     */
    private $strategy;

    /**
     * IsEquals constructor.
     * @param $branchName
     * @param IVersionGenerationStrategy $strategy
     */
    public function __construct($branchName, IVersionGenerationStrategy $strategy)
    {
        $this->branchName = $branchName;
        $this->strategy = $strategy;
    }

    public function versions()
    {
        return $this->strategy->versions();
    }

    public function isFit($branch)
    {
        return $branch == $this->branchName;
    }


}
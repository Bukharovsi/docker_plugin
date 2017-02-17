<?php

namespace Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy;

use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;

class InStrategy implements IVersionGenerationStrategyWithCondition
{
    private $branchNames = [];

    /**
     * @var IVersionGenerationStrategy
     */
    private $strategy;

    /**
     * IsEquals constructor.
     * @param $branchNames
     * @param IVersionGenerationStrategy $strategy
     */
    public function __construct(array $branchNames, IVersionGenerationStrategy $strategy)
    {
        $this->branchNames = $branchNames;
        $this->strategy = $strategy;
    }

    public function versions()
    {
        return $this->strategy->versions();
    }

    public function isFit($branch)
    {
        return in_array($branch, $this->branchNames);
    }


}
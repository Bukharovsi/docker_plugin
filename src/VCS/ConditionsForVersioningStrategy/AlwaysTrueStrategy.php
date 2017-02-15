<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 13:21
 */

namespace Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy;


use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;

class AlwaysTrueStrategy implements IVersionGenerationStrategyWithCondition
{

    /**
     * @var IVersionGenerationStrategy
     */
    private $strategy;

    /**
     * IsEquals constructor.
     * @param IVersionGenerationStrategy $strategy
     */
    public function __construct(IVersionGenerationStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function versions()
    {
        return $this->strategy->versions();
    }

    public function isFit($branch)
    {
        return true;
    }
}
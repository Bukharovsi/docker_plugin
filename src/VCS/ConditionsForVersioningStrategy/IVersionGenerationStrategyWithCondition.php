<?php

namespace Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy;

use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;

interface IVersionGenerationStrategyWithCondition extends IVersionGenerationStrategy
{
    public function isFit($branch);
}

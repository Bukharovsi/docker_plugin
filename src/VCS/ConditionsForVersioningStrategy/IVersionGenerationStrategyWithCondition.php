<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.02.17
 * Time: 23:00
 */

namespace Bukharovsi\DockerPlugin\VCS\ConditionsForVersioningStrategy;


use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;

interface IVersionGenerationStrategyWithCondition extends IVersionGenerationStrategy
{
    public function isFit($branch);
}
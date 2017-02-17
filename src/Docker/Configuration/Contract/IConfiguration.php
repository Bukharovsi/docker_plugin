<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Contract;

/**
 * Interface IConfiguration
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
interface IConfiguration extends IDockerImageConfiguration, IReportConfiguration
{
    public function override(IConfiguration $configuration);
}
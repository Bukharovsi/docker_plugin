<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:21
 */
namespace Bukharovsi\DockerPlugin\Docker\Configuration\Contract;

/**
 * Interface IConfiguration
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
interface IConfiguration extends IDockerImageConfiguration, IReportConfiguration
{
    public function override(IConfiguration $configuration);
}
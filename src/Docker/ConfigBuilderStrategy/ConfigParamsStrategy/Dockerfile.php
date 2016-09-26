<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 17:47
 */

namespace Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy;

use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Interfaces\DockerConfigParamInterface;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Dockerfile
 *
 * @package Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy
 */
class Dockerfile implements DockerConfigParamInterface
{
    /**
     * @param array                $dockerConfig
     * @param RootPackageInterface $packageInfo
     * @param InputInterface       $input
     *
     * @return string
     */
    public function build(array $dockerConfig, RootPackageInterface $packageInfo, InputInterface $input)
    {
        return isset($dockerConfig['dockerfile']) && is_string($dockerConfig['dockerfile']) ?
            $dockerConfig['dockerfile'] :
            null;
    }
}

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
 * Class WorkingDirectory
 *
 * @package Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy
 */
class WorkingDirectory implements DockerConfigParamInterface
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
        return isset($dockerConfig['workingDirectory']) && is_string($dockerConfig['workingDirectory']) ?
            $dockerConfig['workingDirectory'] :
            null;
    }
}

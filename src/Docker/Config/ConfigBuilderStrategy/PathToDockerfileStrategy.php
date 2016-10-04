<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 17:47
 */

namespace Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy;

use Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\Interfaces\DockerExecutionParamsChoosingStrategy;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class PathToDockerfileStrategy
 *
 * @package Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy
 */
class PathToDockerfileStrategy implements DockerExecutionParamsChoosingStrategy
{
    /**
     * {@inheritdoc}
     *
     * @return string|null path to dockerfile
     */
    public function build(array $dockerConfig, RootPackageInterface $packageInfo, InputInterface $input)
    {
        return isset($dockerConfig['dockerfile']) && is_string($dockerConfig['dockerfile']) ?
            $dockerConfig['dockerfile'] :
            null;
    }
}

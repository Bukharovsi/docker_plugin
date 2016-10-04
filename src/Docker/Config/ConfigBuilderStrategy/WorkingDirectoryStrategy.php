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
 * Class WorkingDirectoryStrategy
 *
 * @package Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy
 */
class WorkingDirectoryStrategy implements DockerExecutionParamsChoosingStrategy
{
    /**
     * {@inheritdoc}
     *
     * @return string|null
     */
    public function build(array $dockerConfig, RootPackageInterface $packageInfo, InputInterface $input)
    {
        return isset($dockerConfig['workingDirectory']) && is_string($dockerConfig['workingDirectory']) ?
            $dockerConfig['workingDirectory'] :
            null;
    }
}

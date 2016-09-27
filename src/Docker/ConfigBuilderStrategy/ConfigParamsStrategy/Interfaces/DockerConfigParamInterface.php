<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 12:23
 */

namespace Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Interfaces;

use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Interface DockerConfigParamInterface
 *
 * todo Interface DockerExecutionParamsChoosingStrategy
 *
 * @package Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Interfaces
 */
interface DockerConfigParamInterface
{
    /**
     * @param array                $dockerConfig
     * @param RootPackageInterface $packageInfo
     * @param InputInterface       $input
     *
     * @return mixed
     */
    public function build(array $dockerConfig, RootPackageInterface $packageInfo, InputInterface $input);
}

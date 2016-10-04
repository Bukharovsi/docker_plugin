<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 12:23
 */

namespace Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\Interfaces;

use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Interface DockerExecutionParamsChoosingStrategy
 *
 * @package Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\Interfaces
 */
interface DockerExecutionParamsChoosingStrategy
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

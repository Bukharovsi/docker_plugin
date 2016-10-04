<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 12:25
 */

namespace Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy;

use Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\Interfaces\DockerExecutionParamsChoosingStrategy;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class ImageNameStrategy
 *
 * @package Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy
 */
class ImageNameStrategy implements DockerExecutionParamsChoosingStrategy
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function build(array $dockerConfig, RootPackageInterface $packageInfo, InputInterface $input)
    {
        return array_key_exists('name', $dockerConfig) ?
            $dockerConfig['name'] :
            $packageInfo->getPrettyName();
    }
}

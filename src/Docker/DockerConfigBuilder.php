<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 16:39
 */

namespace Bukharovsi\DockerPlugin\Docker;

use Bukharovsi\DockerPlugin\Docker\Config\DockerConfig;
use Bukharovsi\DockerPlugin\Docker\Config\DockerConfigParameters;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\DockerConfigBuilderStrategy;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class DockerConfigBuilder
 *
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerConfigBuilder
{
    private $dockerConfigBuilderStrategy;

    /**
     * DockerConfigBuilder constructor.
     *
     * @param InputInterface       $input
     * @param RootPackageInterface $packageInfo
     */
    public function __construct(InputInterface $input, RootPackageInterface $packageInfo)
    {
        $this->dockerConfigBuilderStrategy = new DockerConfigBuilderStrategy($input, $packageInfo);
    }

    /**
     * @return DockerConfig
     */
    public function buildDockerConfig()
    {
        $dockerConfig = new DockerConfig();
        $dockerConfig->setImageName(
            $this->dockerConfigBuilderStrategy->build(
                DockerConfigParameters::IMAGE_NAME
            )
        );
        $dockerConfig->setImageTag(
            $this->dockerConfigBuilderStrategy->build(
                DockerConfigParameters::IMAGE_TAG
            )
        );
        $dockerConfig->setDockerfile(
            $this->dockerConfigBuilderStrategy->build(
                DockerConfigParameters::DOCKERFILE
            )
        );
        $dockerConfig->setWorkingDirectory(
            $this->dockerConfigBuilderStrategy->build(
                DockerConfigParameters::WORKING_DIRECTORY
            )
        );

        return $dockerConfig;
    }
}

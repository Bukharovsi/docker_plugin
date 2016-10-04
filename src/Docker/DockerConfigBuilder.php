<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 16:39
 */

namespace Bukharovsi\DockerPlugin\Docker;

use Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\ImageNameStrategy;
use Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\ImageTagStrategy;
use Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\PathToDockerfileStrategy;
use Bukharovsi\DockerPlugin\Docker\Config\ConfigBuilderStrategy\WorkingDirectoryStrategy;
use Bukharovsi\DockerPlugin\Docker\Config\DockerConfig;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class DockerConfigBuilder
 *
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerConfigBuilder
{
    /**
     * @var array of params from composer.json
     */
    private $dockerConfig;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var RootPackageInterface
     */
    private $packageInfo;

    /**
     * @var ImageNameStrategy
     */
    private $imageNameStrategy;

    /**
     * @var ImageTagStrategy
     */
    private $imageTagStrategy;

    /**
     * @var PathToDockerfileStrategy
     */
    private $pathToDockerfileStrategy;

    /**
     * @var WorkingDirectoryStrategy
     */
    private $workingDirectoryStrategy;

    /**
     * DockerConfigBuilder constructor.
     *
     * @param InputInterface       $input
     * @param RootPackageInterface $packageInfo
     */
    public function __construct(InputInterface $input, RootPackageInterface $packageInfo)
    {
        $this->input = $input;
        $this->packageInfo = $packageInfo;
        $this->dockerConfig = $this->getDockerConfigFromComposer();

        $this->imageNameStrategy = new ImageNameStrategy();
        $this->imageTagStrategy = new ImageTagStrategy();
        $this->pathToDockerfileStrategy = new PathToDockerfileStrategy();
        $this->workingDirectoryStrategy = new WorkingDirectoryStrategy();
    }

    /**
     * @return DockerConfig
     */
    public function buildDockerConfig()
    {
        $dockerConfig = new DockerConfig();
        $dockerConfig->setImageName(
            $this->imageNameStrategy->build(
                $this->dockerConfig,
                $this->packageInfo,
                $this->input
            )
        );
        $dockerConfig->setImageTag(
            $this->imageTagStrategy->build(
                $this->dockerConfig,
                $this->packageInfo,
                $this->input
            )
        );
        $dockerConfig->setDockerfile(
            $this->pathToDockerfileStrategy->build(
                $this->dockerConfig,
                $this->packageInfo,
                $this->input
            )
        );
        $dockerConfig->setWorkingDirectory(
            $this->workingDirectoryStrategy->build(
                $this->dockerConfig,
                $this->packageInfo,
                $this->input
            )
        );

        return $dockerConfig;
    }

    /**
     * Return docker config from composer json
     *
     * @return array
     */
    private function getDockerConfigFromComposer()
    {
        $buildName = isset($this->input->getArguments()['buildName']) ?
            $this->input->getArguments()['buildName'] :
            "default";

        $extra = $this->packageInfo->getExtra();
        if (!isset($extra['docker'])) {
            return [];
        }

        $dockerBuilds = $extra['docker'];
        if (!array_key_exists($buildName, $dockerBuilds)) {
            return [];
        }

        return $dockerBuilds[$buildName];
    }
}

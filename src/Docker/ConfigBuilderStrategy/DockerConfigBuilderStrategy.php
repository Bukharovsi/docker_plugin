<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 12:03
 */

namespace Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy;

use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\Config\DockerConfigParameters;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Dockerfile;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\ImageName;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\ImageTag;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Interfaces\DockerConfigParamInterface;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\WorkingDirectory;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class DockerConfigBuilderStrategy
 *
 * @package Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy
 */
class DockerConfigBuilderStrategy
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
     * @var ImageName
     */
    private $imageNameStrategy;

    /**
     * @var ImageTag
     */
    private $imageTagStrategy;

    /**
     * @var Dockerfile
     */
    private $dockerfileStrategy;

    /**
     * @var WorkingDirectory
     */
    private $workingDirectoryStrategy;

    /**
     * DockerConfigBuilderStrategy constructor.
     *
     * @param InputInterface       $input
     * @param RootPackageInterface $packageInfo
     */
    public function __construct(InputInterface $input, RootPackageInterface $packageInfo)
    {
        $this->input = $input;
        $this->packageInfo = $packageInfo;
        $this->dockerConfig = $this->getDockerConfigFromComposer();

        $this->imageNameStrategy = new ImageName();
        $this->imageTagStrategy = new ImageTag();
        $this->dockerfileStrategy = new Dockerfile();
        $this->workingDirectoryStrategy = new WorkingDirectory();
    }

    /**
     * @param DockerConfigParamInterface $imageNameStrategy
     */
    public function setImageNameStrategy(DockerConfigParamInterface $imageNameStrategy)
    {
        $this->imageNameStrategy = $imageNameStrategy;
    }

    /**
     * @param DockerConfigParamInterface $imageTagStrategy
     */
    public function setImageTagStrategy(DockerConfigParamInterface $imageTagStrategy)
    {
        $this->imageTagStrategy = $imageTagStrategy;
    }

    /**
     * Build config params
     *
     * @param $param
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function build($param)
    {
        $paramBuilder = null;
        switch ($param) {
            case DockerConfigParameters::IMAGE_NAME:
                $paramBuilder = $this->imageNameStrategy;
                break;
            case DockerConfigParameters::IMAGE_TAG:
                $paramBuilder = $this->imageTagStrategy;
                break;
            case DockerConfigParameters::DOCKERFILE:
                $paramBuilder = $this->dockerfileStrategy;
                break;
            case DockerConfigParameters::WORKING_DIRECTORY:
                $paramBuilder = $this->workingDirectoryStrategy;
                break;
            default:
                throw new \Exception('Not found docker config param = ' . $param);
                break;
        }

        return $paramBuilder->build($this->dockerConfig, $this->packageInfo, $this->input);
    }

    /**
     * Return docker config from composer json
     *
     * @return array
     */
    private function getDockerConfigFromComposer()
    {
        $buildName = $this->input->getArguments()['buildName'];
        $extra = $this->packageInfo->getExtra();
        if (!array_key_exists('docker', $extra)) {
            throw DockerExecutionException::installPluginError();
        }

        $dockerBuilds = $extra['docker'];
        if (!array_key_exists($buildName, $dockerBuilds)) {
            throw DockerExecutionException::buildSectionNameError();
        }

        return $dockerBuilds[$buildName];
    }
}

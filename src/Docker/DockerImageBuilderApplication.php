<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 17:42
 */

namespace Bukharovsi\DockerPlugin\Docker;
use Bukharovsi\DockerPlugin\Docker\Configuration\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\Configuration\IConfigurator;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class DockerImageBuilderApplication
 * @package Bukharovsi\DockerPlugin\Docker
 */
class DockerImageBuilderApplication
{
    /**
     * @var IConfigurator
     */
    private $configurator;

    /**
     * @var RootPackageInterface
     */
    private $packageInfo;

    /**
     * DockerImageBuilderApplication constructor.
     * @param IConfigurator $configurator
     */
    public function __construct(RootPackageInterface $rootPackage)
    {

        $this->packageInfo = $rootPackage;
    }

    public function buildDockerImage(InputInterface $input) {
        $this->configurator = new ComposerProjectConfigurator($input, $this->packageInfo);
        $configuraton = $this->configurator->makeConfiguration();

        $dockerImage = $this->dockerImageBuilder->build($configuraton);
        $dockerImage->build();
    }


}
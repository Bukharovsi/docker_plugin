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
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ICommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Image\DockerImage;
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
     * @var ICommandBuilder
     */
    private $commandBuilder;

    /**
     * DockerImageBuilderApplication constructor.
     * @param IConfigurator $configurator
     */
    public function __construct(RootPackageInterface $rootPackage, ICommandBuilder $commandBuilder)
    {
        $this->packageInfo = $rootPackage;
        $this->commandBuilder = $commandBuilder;
    }

    public function buildDockerImage(InputInterface $input)
    {
        $image = $this->createImage($input);
        $image->build();
    }

    public function pushDockerImage(InputInterface $input)
    {
        $image = $this->createImage($input);
        $image->push();
    }

    /**
     * @param InputInterface $input
     */
    private function createImage(InputInterface $input)
    {
        $this->configurator = new ComposerProjectConfigurator($input, $this->packageInfo);
        $configuraton = $this->configurator->makeConfiguration();

        $image = new DockerImage($configuraton, $this->commandBuilder);

        return $image;
    }


}
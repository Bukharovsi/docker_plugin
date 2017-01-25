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
use Symfony\Component\Console\Output\OutputInterface;

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

    public function buildDockerImage(InputInterface $input, OutputInterface $output)
    {
        $this->configurator = new ComposerProjectConfigurator($input, $this->packageInfo);
        $configuraton = $this->configurator->makeConfiguration();

        $image = new DockerImage($configuraton, $this->commandBuilder);

        $builtImage = $image->build();

        $reports = new ReportCollection($builtImage, $configuraton, $output);
        $reports->make();
    }

    public function pushDockerImage(InputInterface $input)
    {
        $this->configurator = new ComposerProjectConfigurator($input, $this->packageInfo);
        $configuraton = $this->configurator->makeConfiguration();

        $image = new DockerImage($configuraton, $this->commandBuilder);

        $image->push();
    }
    
}
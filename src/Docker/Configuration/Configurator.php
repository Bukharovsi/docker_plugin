<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 0:56
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Configurator
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
class Configurator
{

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var RootPackageInterface
     */
    private $packageInfo;

    /**
     * Configurator constructor.
     * @param InputInterface $input
     * @param RootPackageInterface $packageInfo
     */
    public function __construct(InputInterface $input, RootPackageInterface $packageInfo)
    {
        $this->input = $input;
        $this->packageInfo = $packageInfo;
    }


    /**
     * @param InputInterface $input
     * @param RootPackageInterface $packageInfo
     * @return IConfiguration
     */
    public function makeConfiguration() {
        $composerDefaultParameters = new DefaultComposerConfiguration($this->packageInfo);
        $composerJsonParameters = new ComposerJsonConfiguration($this->packageInfo->getExtra());
        $cmdParameters = new ConsoleInputConfiguration($this->input);

        $composerJsonParameters->override($composerDefaultParameters);
        $cmdParameters->override($composerJsonParameters);

        return $cmdParameters;
    }
}
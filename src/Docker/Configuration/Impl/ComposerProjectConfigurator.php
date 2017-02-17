<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Impl;


use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfigurator;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Configurator
 *
 * Configurator for composer projects
 *
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
class ComposerProjectConfigurator implements IConfigurator
{
    /**
     * @var RootPackageInterface
     */
    private $packageInfo;

    /**
     * Configurator constructor.
     * @param RootPackageInterface $packageInfo
     */
    public function __construct(RootPackageInterface $packageInfo)
    {
        $this->packageInfo = $packageInfo;
    }


    /**
     * @param InputInterface $input
     * @return IConfiguration
     */
    public function makeConfiguration(InputInterface $input) {
        $composerDefaultConf = new DefaultComposerConfiguration($this->packageInfo);
        $composerJsonConf = new ComposerJsonConfiguration($this->packageInfo->getExtra());
        $cmdParameters = new ConsoleInputConfiguration($input);

        $composerJsonConf->override($composerDefaultConf);
        $cmdParameters->override($composerJsonConf);

        return $cmdParameters;
    }
}
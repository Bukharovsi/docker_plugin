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
        $composerDefaultParameters = new DefaultComposerConfiguration($this->packageInfo);
        $composerJsonParameters = new ComposerJsonConfiguration($this->packageInfo->getExtra());
        $cmdParameters = new ConsoleInputConfiguration($input);

        $composerJsonParameters->override($composerDefaultParameters);
        $cmdParameters->override($composerJsonParameters);

        return $cmdParameters;
    }
}
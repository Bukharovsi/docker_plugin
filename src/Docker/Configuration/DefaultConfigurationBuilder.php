<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 0:56
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


use Composer\Package\RootPackageInterface;
use Docker\Configuration\ComposerDefaultParameters;

class DefaultConfigurationBuilder
{
    /**
     * @param InputInterface $input
     * @param RootPackageInterface $packageInfo
     * @return ICommandParameters
     */
    public function build(InputInterface $input, RootPackageInterface $packageInfo) {
        $composerDefaultParameters = new ComposerDefaultParameters($packageInfo);
        $composerJsonParameters = new ComposerJsonParameters($packageInfo);
        $cmdParameters = new InputCommandParameters($input);

        $composerJsonParameters->override($composerDefaultParameters);
        $cmdParameters->override($composerJsonParameters);

        $packageInfo->getInstallationSource()

        return $cmdParameters;
    }
}
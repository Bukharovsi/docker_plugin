<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 0:34
 */

namespace Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\CommandParameters;
use Composer\Package\RootPackageInterface;

class ComposerDefaultParameters extends CommandParameters
{

    /**
     * ComposerDefaultParameters constructor.
     * @param RootPackageInterface $rootPackage
     */
    public function __construct(RootPackageInterface $rootPackage)
    {
        $this->imageName = $rootPackage->getName();
        $this->imageTag = $rootPackage->getVersion();
    }
}
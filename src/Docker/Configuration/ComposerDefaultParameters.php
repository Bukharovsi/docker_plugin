<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 0:34
 */

namespace Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\AbstractCommandParameters;
use Composer\Package\RootPackageInterface;

class ComposerDefaultParameters extends AbstractCommandParameters
{

    /**
     * ComposerDefaultParameters constructor.
     * @param RootPackageInterface $rootPackage
     */
    public function __construct(RootPackageInterface $rootPackage)
    {
        parent::__construct();

        $this->imageName = $rootPackage->getName();
        $this->addTag($rootPackage->getVersion());
    }
}
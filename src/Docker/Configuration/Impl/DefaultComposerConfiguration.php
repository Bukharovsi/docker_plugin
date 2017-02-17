<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Impl;

use Composer\Package\RootPackageInterface;

/**
 * Class ComposerDefaultParameters
 *
 * define default configuration for all composer projects
 *
 * @package Docker\Configuration
 */
class DefaultComposerConfiguration extends AbstractConfiguration
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

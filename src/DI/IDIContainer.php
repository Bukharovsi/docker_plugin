<?php

namespace Bukharovsi\DockerPlugin\DI;

use Composer\Package\RootPackageInterface;

/**
 * Interface IDIContainer
 *
 * This is common interface for DI Container for this application
 *
 */
interface IDIContainer
{
    public function application(RootPackageInterface $package);
}

<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 29.01.17
 * Time: 13:40
 */

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
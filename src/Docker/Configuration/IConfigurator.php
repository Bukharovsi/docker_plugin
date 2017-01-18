<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 17:43
 */
namespace Bukharovsi\DockerPlugin\Docker\Configuration;

use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Class Configurator
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
interface IConfigurator
{
    /**
     * @return IConfiguration
     */
    public function makeConfiguration();
}
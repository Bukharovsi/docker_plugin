<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 07.09.16
 * Time: 16:11
 */

namespace Bukharovsi\DockerPlugin;

use Bukharovsi\DockerPlugin\Command\DockerCommandProvider;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

/**
 * Class DockerPlugin
 *
 * @package Bukharovsi\DockerPlugin
 */
class DockerPlugin implements PluginInterface, Capable
{
    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
    }

    /**
     * @return array
     */
    public function getCapabilities()
    {
        return [
            CommandProvider::class => DockerCommandProvider::class
        ];
    }
}
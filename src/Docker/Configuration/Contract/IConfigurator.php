<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Contract;

use Symfony\Component\Console\Input\InputInterface;


/**
 * Class Configurator
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
interface IConfigurator
{
    /**
     * @param InputInterface $input
     *
     * @return IConfiguration
     */
    public function makeConfiguration(InputInterface $input);
}
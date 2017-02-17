<?php

namespace Bukharovsi\DockerPlugin\VCS\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfigurator;
use Bukharovsi\DockerPlugin\VCS\VCSConfigurationDecorator;
use Bukharovsi\DockerPlugin\VCS\VCSVersioningStrategy;
use GitElephant\Repository;
use Symfony\Component\Console\Input\InputInterface;

class VCSConfiguratorDecorator implements IConfigurator
{

    /**
     * @var IConfigurator
     */
    private $decorated;

    /**
     * @var VCSVersioningStrategy
     */
    private $vcsVersionStrategy;

    /**
     * VCSConfiguratorDecorator constructor.
     * @param IConfigurator $decorated
     */
    public function __construct(IConfigurator $decorated, VCSVersioningStrategy $versioningStrategy)
    {
        $this->decorated = $decorated;
        $this->vcsVersionStrategy = $versioningStrategy;
    }


    public function makeConfiguration(InputInterface $input)
    {
        $conf = $this->decorated->makeConfiguration($input);
        $configuration = new VCSConfigurationDecorator(
            $conf,
            $this->vcsVersionStrategy
        );

        return $configuration;
    }

}
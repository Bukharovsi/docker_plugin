<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.02.17
 * Time: 16:22
 */

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
     * VCSConfiguratorDecorator constructor.
     * @param IConfigurator $decorated
     */
    public function __construct(IConfigurator $decorated)
    {
        $this->decorated = $decorated;
    }


    public function makeConfiguration(InputInterface $input)
    {
        $conf = $this->decorated->makeConfiguration($input);
        $configuration = new VCSConfigurationDecorator(
            $conf,
            new VCSVersioningStrategy(new Repository($conf->workingDirectory()))
        );

        return $configuration;
    }

}
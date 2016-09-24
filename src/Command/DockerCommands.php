<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 12:26
 */

namespace Bukharovsi\DockerPlugin\Command;

use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\DockerConfig;
use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DockerCommands
 *
 * @package Bukharovsi\DockerPlugin\Command
 */
abstract class DockerCommands extends BaseCommand
{
    /**
     * @var DockerConfig
     */
    protected $dockerConfig;

    /**
     * Return command name
     *
     * @return string
     */
    abstract protected function getCommandName();

//    abstract protected function executeCommand();

    protected function configure()
    {
        $commandName = $this->getCommandName();
        $this->setName($commandName);
        $this->addArgument(
            'buildName',
            InputArgument::OPTIONAL,
            'Name of the docker build. If not present use "default" value',
            'default'
        );
        $this->addOption('tag', 't', InputOption::VALUE_OPTIONAL, "Set the tag of image");

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $buildName = $input->getArguments()['buildName'];
        $dockerBuildConfig = $this->getDockerBuildConfig($buildName);

        $name = array_key_exists('name', $dockerBuildConfig) ?
            $dockerBuildConfig['name'] :
            $this->getComposer()->getPackage()->getPrettyName();

        $version = array_key_exists('version', $dockerBuildConfig) ?
            $this->getVersionForImage($dockerBuildConfig['version']) :
            'latest';


    }

    /**
     * return params for docker build
     *
     * @param InputInterface $input
     *
     * @throws DockerExecutionException
     * @return array
     */
    protected function getDockerBuildConfig(InputInterface $input)
    {
        $buildName = $input->getArguments()['buildName'];
        $extra = $this->getComposer()->getPackage()->getExtra();
        if (!array_key_exists('docker', $extra)) {
            throw DockerExecutionException::installPluginError();
        }

        $dockerBuilds = $extra['docker'];
        if (!array_key_exists($buildName, $dockerBuilds)) {
            throw DockerExecutionException::buildSectionNameError();
        }

        return $dockerBuilds[$buildName];
    }

    protected function getVersionForImage($configVersion)
    {
        if (is_string($configVersion) && $configVersion != '@vcs') {
            return $configVersion;
        }

        // todo. считаем, что версия = @vcs ?
        $branchName = str_replace('dev-', '', $this->getComposer()->getPackage()->getFullPrettyVersion());

        return $branchName;
    }

    /**
     * Return name for docker image
     *
     * @param array $dockerBuildConfig
     *
     * @return string
     */
    protected function getImageName($dockerBuildConfig)
    {
        return array_key_exists('name', $dockerBuildConfig) ?
            $dockerBuildConfig['name'] :
            $this->getComposer()->getPackage()->getPrettyName();
    }


    protected function getImageVersion($dockerBuildConfig)
    {
        return array_key_exists('version', $dockerBuildConfig) ?
            $this->getVersionForImage($dockerBuildConfig['version']) :
            'latest';
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 23.09.16
 * Time: 12:26
 */

namespace Bukharovsi\DockerPlugin\Command;

use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\Config\DockerConfig;
use Bukharovsi\DockerPlugin\Docker\DockerConfigBuilder;
use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DockerCommands
 *
 * @package Bukharovsi\DockerPlugin\Command
 *
 * todo название должно быть другое типа BaseDockerCommand
 */
abstract class DockerCommands extends BaseCommand
{
    /**
     * @var DockerConfig
     * todo не вижу где используется
     */
    protected $dockerConfig;

    /**
     * Return command name
     *
     * @return string
     */
    abstract protected function getCommandName();

    //todo где докблок?
    //todo что-то мне подсказывает что эти2  метода должы жить в разных местах.
    //todo getDockerConfig - нужен всем командам. а configure задает команду с 2мя параметрами. Name и tag. а если параметры будут другими мы не ссможем воспользоваться этим классом уже
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

    /**
     * return params for docker
     *
     * TODO здесь нужно поронее расписать что это параметры уже смерженые и из командной строки и из конфигурационного файла
     * todo и возможно даже дефолтные. get params for docker слишком асбтрактно
     *
     * @param InputInterface $input
     *
     * @throws DockerExecutionException
     * @return DockerConfig
     */
    protected function getDockerConfig(InputInterface $input)
    {
        $dockerConfigBuilder = new DockerConfigBuilder(
            $input,
            $this->getComposer()->getPackage()
        );

        return $dockerConfigBuilder->buildDockerConfig();
    }
}

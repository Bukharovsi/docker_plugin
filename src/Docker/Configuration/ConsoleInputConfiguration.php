<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 11:49
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class InputCommandParameters
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
class ConsoleInputConfiguration extends AbstractConfiguration
{

    const TAG = 'tag';
    const NAME = 'name';
    const DOCKERFILE='dockerfile';
    const WORKING_DIRECTORY='workingdirectory';

    /**
     * InputCommandParameters constructor.
     * @param InputInterface $input
     */
    public function __construct(InputInterface $input) {
        parent::__construct();

        $this->imageTags = $input->getOption(static::TAG);
        $this->imageName = $input->getOption(static::NAME);
        $this->dockerFilePath = $input->getOption(static::DOCKERFILE);
        $this->workingDirectory = $input->getOption(static::WORKING_DIRECTORY);
    }

    public static function createInputDefinition() {
        $definition = new InputDefinition();
        $definition->addOption(
            new InputOption(
                static::TAG, 't',
                InputOption::VALUE_OPTIONAL|InputOption::VALUE_IS_ARRAY,
                "Set the tag of image"
            )
        );

        $definition->addOption(
            new InputOption(static::NAME, 'n',
                InputOption::VALUE_OPTIONAL,
                "Set name of image"
            )
        );

        $definition->addOption(
            new InputOption(
                static::DOCKERFILE, 'd',
                InputOption::VALUE_OPTIONAL,
                "Specify dockerfile"
            )
        );

        $definition->addOption(
            new InputOption(
                static::WORKING_DIRECTORY, 'wd',
                InputOption::VALUE_OPTIONAL,
                'Specify working directory'
            )
        );

        return $definition;
    }
}
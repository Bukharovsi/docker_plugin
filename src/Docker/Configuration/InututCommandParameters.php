<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 11:49
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

class InputCommandParameters extends AbstractCommandParameters
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
        $this->imageTag = $input->getOption(static::TAG);
        $this->imageName = $input->getOption(static::NAME);
        $this->dockerFilePath = $input->getOption(static::DOCKERFILE);
        $this->workingDirectory = $input->getOption(static::WORKING_DIRECTORY);
    }

    public function configureCommand(Command $command) {
        $command->addOption(static::TAG, 't', InputOption::VALUE_IS_ARRAY, "Set the tag of image");
        $command->addOption(static::NAME, 'n', InputOption::VALUE_OPTIONAL, "Set name of image");
        $command->addOption(static::DOCKERFILE, 'd', InputOption::VALUE_OPTIONAL, "Specify dockerfile");
        $command->addOption(static::WORKING_DIRECTORY, 'wd', InputOption::VALUE_OPTIONAL, 'Specify working directory');

    }
}
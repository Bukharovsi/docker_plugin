<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 10:17
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;

class ComposerJsonParameters extends AbstractCommandParameters
{

    const DOCKER_PLUGIN_EXTRA_KEY = 'docker';

    const IMAGE_NAME = 'name';

    const IMAGE_TAG = 'tag';

    const DOCKERFILE = 'dockerfile';

    const WORKING_DIRECTORY = 'workingdirectory';

    private $extraDockerConfig = [];


    /**
     * ComposerJsonParameters constructor.
     * @param array $extraFromPackage
     */
    public function __construct($extraFromPackage)
    {
        parent::__construct();

        if (is_array($extraFromPackage) && array_key_exists(static::DOCKER_PLUGIN_EXTRA_KEY, $extraFromPackage)) {
            $this->extraDockerConfig = $extraFromPackage[static::DOCKER_PLUGIN_EXTRA_KEY];
        } else {
            //log this
        }
    }

    public function imageName()
    {
        if (array_key_exists(static::IMAGE_NAME, $this->extraDockerConfig)) {
            $this->imageName = $this->extraDockerConfig[static::IMAGE_NAME];
        }
        return parent::imageName();
    }

    public function imageTag()
    {
        if (array_key_exists(static::IMAGE_TAG, $this->extraDockerConfig)) {
            $this->imageTag = $this->extraDockerConfig[static::IMAGE_TAG];
        }
        return parent::imageTag();
    }

    public function dockerFilePath()
    {
        if (array_key_exists(static::DOCKERFILE, $this->extraDockerConfig)) {
            $this->dockerFilePath = $this->extraDockerConfig[static::DOCKERFILE];
        }
        return parent::dockerFilePath();
    }

    public function workingDirectory()
    {
        if (array_key_exists(static::WORKING_DIRECTORY, $this->extraDockerConfig)) {
            $this->workingDirectory = $this->extraDockerConfig[static::WORKING_DIRECTORY];
        }
        return parent::workingDirectory();
    }


}
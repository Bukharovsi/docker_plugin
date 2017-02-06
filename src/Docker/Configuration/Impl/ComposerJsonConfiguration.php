<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 10:17
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Impl;

/**
 * Class ComposerJsonConfiguration
 *
 * Define configuration based on composer.json file
 *
 * to define configuration provide "extra" section
 *
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
class ComposerJsonConfiguration extends AbstractConfiguration
{

    const DOCKER_PLUGIN_EXTRA_KEY = 'docker';

    const IMAGE_NAME = 'name';

    const IMAGE_TAG = 'tag';

    const DOCKERFILE = 'dockerfile';

    const WORKING_DIRECTORY = 'workingdirectory';

    const REPORTS = 'reports';

    const OUT_REPORT_PATH = 'out-report-path';

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

    public function imageTags()
    {
        if (array_key_exists(static::IMAGE_TAG, $this->extraDockerConfig)) {
            $tags = $this->extraDockerConfig[static::IMAGE_TAG];
            if (!is_array($tags)) {
                $tags = [$tags];
            }

            $this->imageTags = $tags;
        }
        return parent::imageTags();
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

    public function reports()
    {
        if (array_key_exists(static::REPORTS, $this->extraDockerConfig)) {
            $this->reports = $this->extraDockerConfig[static::REPORTS];
        }

        return parent::reports();
    }

    public function outputReportPath()
    {
        if (array_key_exists(static::OUT_REPORT_PATH, $this->extraDockerConfig)) {
            $this->outputReportPath = $this->extraDockerConfig[static::OUT_REPORT_PATH];
        }

        return parent::outputReportPath();
    }


}
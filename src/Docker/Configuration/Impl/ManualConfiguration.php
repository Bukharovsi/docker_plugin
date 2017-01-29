<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:11
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Impl;


use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\AbstractConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\DefaultConfiguration;

class ManualConfiguration extends AbstractConfiguration
{
    /**
     * CommandParameters constructor.
     * @param string $imageName
     * @param string[] $imageTag
     * @param string $dockerFilePath
     * @param string $workingDirectory
     * @param string[] $reports
     */
    public function __construct($imageName = null, $imageTag = null, $dockerFilePath = null, $workingDirectory = null, $reports = null) {
       $this->overridenConfig = new DefaultConfiguration();

        $this->imageName = $imageName;
        $this->setTags($imageTag);
        $this->dockerFilePath = $dockerFilePath;
        $this->workingDirectory = $workingDirectory;
        $this->reports = $reports;
    }

}
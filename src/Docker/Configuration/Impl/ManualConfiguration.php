<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Impl;


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
    public function __construct(
        $imageName = null,
        $imageTag = null,
        $dockerFilePath = null,
        $workingDirectory = null,
        $reports = null,
        $reportOutPath = null
    ) {
       parent::__construct();
        $this->overridenConfig = new DefaultConfiguration();

        $this->imageName = $imageName;
        $this->setTags($imageTag);
        $this->dockerFilePath = $dockerFilePath;
        $this->workingDirectory = $workingDirectory;
        $this->reports = $reports;
        $this->outputReportPath = $reportOutPath;
    }

}
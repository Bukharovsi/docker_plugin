<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Impl;

use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfiguration;

/**
 * Class AbstractConfiguration
 *
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
abstract class AbstractConfiguration implements IConfiguration
{

    /**
     * @var string
     */
    protected $imageName;

    /**
     * @var string[]
     */
    protected $imageTags;

    /**
     * @var string
     */
    protected $dockerFilePath;

    /**
     * @var string
     */
    protected $workingDirectory;

    /**
     * @var string
     */
    protected $reports;

    /**
     * @var string
     */
    protected $outputReportPath;

    /**
     * @var IConfiguration;
     */
    protected $overridenConfig;

    /**
     * AbstractCommandParameters constructor.
     */
    public function __construct()
    {
        $this->overridenConfig = new DefaultConfiguration();
    }


    public function override(IConfiguration $configuration)
    {
        $this->overridenConfig = $configuration;
    }

    public function imageName()
    {
        if (null != $this->imageName) {
            $imageName = $this->imageName;
        } else {
            $imageName = $this->overridenConfig->imageName();
        }

        return $imageName;
    }

    public function imageTags()
    {
        if (null != $this->imageTags) {
            $imageTag = $this->imageTags;
        } else {
            $imageTag = $this->overridenConfig->imageTags();
        }

        return $imageTag;
    }

    protected function addTag($tag)
    {
        if (null == $tag) {
            return;
        }

        if (null == $this->imageTags) {
            $this->imageTags = [];
        }

        $this->imageTags[] = $tag;
    }

    /**
     * @param string[]|string $tags
     */
    protected function setTags($tags)
    {
        if (!(null == $tags || is_array($tags))) {
            $tags = [$tags];
        }
        $this->imageTags = $tags;
    }

    public function dockerFilePath()
    {
        if (null != $this->dockerFilePath) {
            $dockerfile = $this->dockerFilePath;
        } else {
            $dockerfile = $this->overridenConfig->dockerFilePath();
        }

        return $dockerfile;
    }

    public function workingDirectory()
    {
        if (null != $this->workingDirectory) {
            $workingDirectory = $this->workingDirectory;
        } else {
            $workingDirectory = $this->overridenConfig->workingDirectory();
        }

        return $workingDirectory;
    }

    public function reports()
    {
        if (null != $this->reports) {
            $reports = $this->reports;
        } else {
            $reports = $this->overridenConfig->reports();
        }

        return $reports;
    }

    public function outputReportPath()
    {
        if (null != $this->outputReportPath) {
            $outputReportPath = $this->outputReportPath;
        } else {
            $outputReportPath = $this->overridenConfig->outputReportPath();
        }

        return $outputReportPath;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 23:49
 */

namespace Bukharovsi\DockerPlugin\VCS;


use Bukharovsi\DockerPlugin\Docker\Configuration\Contract\IConfiguration;
use Bukharovsi\DockerPlugin\VCS\Strategy\IVersionGenerationStrategy;
use GitElephant\Repository;

/**
 * Class VscConfigurationDecorator
 *
 * if tag is @vcs then tags must be calculated from vcs
 *
 * @package Bukharovsi\DockerPlugin\VCS
 */
class VCSConfigurationDecorator implements IConfiguration
{
    /**
     * @var IConfiguration
     */
    private $decorate;

    private $versionGenerationStrategy;

    /**
     * VscConfigurationDecorator constructor.
     * @param IConfiguration $decorate
     * @param IVersionGenerationStrategy $versionGenerationStrategy
     */
    public function __construct(IConfiguration $decorate, IVersionGenerationStrategy $versionGenerationStrategy)
    {
        $this->decorate = $decorate;
        $this->versionGenerationStrategy = $versionGenerationStrategy;
    }


    public function override(IConfiguration $configuration)
    {
        $this->decorate = $configuration;
    }

    public function imageName()
    {
        return $this->decorate->imageName();
    }

    public function imageTags()
    {
        $tags = $this->decorate->imageTags();
        if (in_array('@vcs', $tags)) {
            $versions = $this->versionGenerationStrategy->versions();
        } else {
            $versions = $tags;
        }

        return $versions;
    }

    public function dockerFilePath()
    {
        return $this->decorate->dockerFilePath();
    }

    public function workingDirectory()
    {
        return $this->decorate->workingDirectory();
    }

    public function reports()
    {
        return $this->decorate->reports();
    }

    public function outputReportPath()
    {
        return $this->decorate->outputReportPath();
    }


}
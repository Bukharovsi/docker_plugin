<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 23:49
 */

namespace Bukharovsi\DockerPlugin\VCS;


use Bukharovsi\DockerPlugin\Docker\Configuration\IConfiguration;

/**
 * Class VscConfigurationDecorator
 *
 * if tag is @vcs then tags must be calculated from vcs
 *
 * @package Bukharovsi\DockerPlugin\VCS
 */
class VscConfigurationDecorator implements IConfiguration
{
    /**
     * @var IConfiguration
     */
    private $decorate;

    /**
     * VscConfigurationDecorator constructor.
     * @param IConfiguration $decorate
     */
    public function __construct(IConfiguration $decorate)
    {
        $this->decorate = $decorate;
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
            // todo return tags from VCS!
        }
    }

    public function dockerFilePath()
    {
        return $this->decorate->dockerFilePath();
    }

    public function workingDirectory()
    {
        return $this->workingDirectory();
    }

}
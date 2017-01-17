<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 0:34
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


abstract class AbstractCommandParameters implements ICommandParameters
{

    protected $imageName;

    protected $imageTag;

    protected $dockerFilePath;

    protected $workingDirectory;

    /**
     * @var ICommandParameters;
     */
    protected $overridedConfig;

    public function override(ICommandParameters $parameters) {
        $this->overridedConfig = $parameters;
    }

    public function imageName() {
        if (null != $this->imageName) {
            $imageName = $this->imageName;
        } else {
            $imageName = $this->overridedConfig->imageName();
        }

        return $imageName;
    }

    public function imageTag() {
        if (null != $this->imageTag) {
            $imageTag = $this->imageTag;
        } else {
            $imageTag = $this->overridedConfig->imageTag();
        }

        return $imageTag;
    }

    public function dockerFilePath() {
        if (null != $this->dockerFilePath) {
            $dockerfile = $this->dockerFilePath;
        } else {
            $dockerfile = $this->overridedConfig->dockerFilePath();
        }

        return $dockerfile;
    }

    public function workingDirectory() {
        if (null != $this->workingDirectory) {
            $wd = $this->workingDirectory;
        } else {
            $wd = $this->overridedConfig->workingDirectory();
        }

        return $wd;
    }


}
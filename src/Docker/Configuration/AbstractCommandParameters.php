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
     * @var ICommandParameters;
     */
    protected $overridenConfig;

    /**
     * AbstractCommandParameters constructor.
     */
    public function __construct() {
        $this->overridenConfig = new DefaultCommandParameters();
    }


    public function override(ICommandParameters $parameters) {
        $this->overridenConfig = $parameters;
    }

    public function imageName() {
        if (null != $this->imageName) {
            $imageName = $this->imageName;
        } else {
            $imageName = $this->overridenConfig->imageName();
        }

        return $imageName;
    }

    public function imageTags() {
        if (null != $this->imageTags) {
            $imageTag = $this->imageTags;
        } else {
            $imageTag = $this->overridenConfig->imageTags();
        }

        return $imageTag;
    }

    protected function addTag($tag) {
        if (null == $this->imageTags) {
            $this->imageTags = [];
        }

        $this->imageTags[$tag];
    }

    /**
     * @param string[]|string $tags
     */
    protected function setTags($tags) {
        if (!(null == $tags ||is_array($tags))) {
            $tags = [$tags];
        }
        $this->imageTags = $tags;
    }

    public function dockerFilePath() {
        if (null != $this->dockerFilePath) {
            $dockerfile = $this->dockerFilePath;
        } else {
            $dockerfile = $this->overridenConfig->dockerFilePath();
        }

        return $dockerfile;
    }

    public function workingDirectory() {
        if (null != $this->workingDirectory) {
            $wd = $this->workingDirectory;
        } else {
            $wd = $this->overridenConfig->workingDirectory();
        }

        return $wd;
    }


}
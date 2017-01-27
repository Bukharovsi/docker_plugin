<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 27.01.17
 * Time: 1:03
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


interface IDockerImageConfiguration
{
    public function imageName();

    public function imageTags();

    public function dockerFilePath();

    public function workingDirectory();
}
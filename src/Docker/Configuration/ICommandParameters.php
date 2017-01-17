<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:21
 */
namespace Bukharovsi\DockerPlugin\Docker\Configuration;

interface ICommandParameters
{
    public function override(ICommandParameters $parameters);

    public function imageName();

    public function imageTag();

    public function dockerFilePath();

    public function workingDirectory();
}
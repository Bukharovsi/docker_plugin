<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:21
 */
namespace Bukharovsi\DockerPlugin\Docker\Configuration;

/**
 * Interface IConfiguration
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
interface IConfiguration
{
    public function override(IConfiguration $parameters);

    public function imageName();

    public function imageTags();

    public function dockerFilePath();

    public function workingDirectory();
}
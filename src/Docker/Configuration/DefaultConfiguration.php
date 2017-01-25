<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:22
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;

/**
 * Class DefaultConfiguration
 *
 * @package Bukharovsi\DockerPlugin\Docker\Configuration
 */
class DefaultConfiguration implements IConfiguration
{
    public function override(IConfiguration $configuration)
    {
        throw DefaultCommandParametersOverridingException::cantOverrideDefaultParameters();
    }

    public function imageName()
    {
        throw DefaultCommandParametersOverridingException::noDefaultValue('image name');
    }

    public function imageTags()
    {
        return ['latest'];
    }

    public function dockerFilePath()
    {
        return 'Dockerfile';
    }

    public function workingDirectory()
    {
        return '.';
    }

    public function reports()
    {
        return [];
    }


}
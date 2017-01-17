<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:22
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;

class DefaultCommandParameters implements ICommandParameters
{
    public function override(ICommandParameters $parameters)
    {
        throw DefaultCommandParametersOverridingException::cantOverrideDefaultParameters();
    }

    public function imageName()
    {
        throw DefaultCommandParametersOverridingException::noDefaultValue('image name');
    }

    public function imageTag()
    {
        return 'latest';
    }

    public function dockerFilePath()
    {
        return 'Dockerfile';
    }

    public function workingDirectory()
    {
        return '.';
    }

}
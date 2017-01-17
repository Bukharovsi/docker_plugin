<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:23
 */

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions;


class DefaultCommandParametersOverridingException extends \Exception
{
    public static function cantOverrideDefaultParameters() {
        return new static("Cant override default parameters");
    }

    public static function noDefaultValue($paramName){
        return new static("There is no default value for $paramName, you need to override this");
    }
}
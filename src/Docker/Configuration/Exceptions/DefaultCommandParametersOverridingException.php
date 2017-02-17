<?php

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
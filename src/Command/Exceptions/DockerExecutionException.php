<?php

namespace Bukharovsi\DockerPlugin\Command\Exceptions;

/**
 * Class DockerExecutionException
 */
class DockerExecutionException extends \RuntimeException
{
    /**
     * @param string $command the failed command
     * @param string|int $code error code
     *
     * @return static
     */
    public static function commandIsExecutedWithError($command, $code)
    {
        return new static(
            "Docker command execution failed. Command \"$command\" is executed and return code $code"
        );
    }

    public static function installPluginError()
    {
        return new static(
            "There are no \"docker\" section into composer.json"
        );
    }

    public static function buildSectionNameError()
    {
        return new static(
            "build section not present"
        );
    }
}

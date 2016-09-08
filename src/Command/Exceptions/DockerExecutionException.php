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
     * @return static
     */
    public static function commandIsExecutedWithError($command, $code) {
        return new static("Docker command execution failed. Command \"$command\" is executed and return code $code");
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 19:27
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Exceptions;


class ExecutionCommandException extends \Exception
{
    public static function buildCommandReturnsNotZeroCode($command, $msg, $code)
    {
        return new static(
            "Docker image build command execution error Returned code: $code. Command is \"$command\", error msg is: "
            .var_export($msg, true)
        );
    }

    public static function pushCommandReurnsNotZeroCode($command, $msg, $code)
    {
        return new static(
            "Docker image push command execution error Returned code: $code. Command is \"$command\", error msg is: "
            .var_export($msg, true)
        );
    }

}
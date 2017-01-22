<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 20:05
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\ExecutionCommand;


use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Exceptions\ExecutionCommandException;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\PushImageCommand;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use phpmock\phpunit\PHPMock;

class PushImageCommandTest extends \PHPUnit_Framework_TestCase
{
    use PHPMock;

    public function testPushImage() {
        $exec = $this->getFunctionMock((new \ReflectionClass(PushImageCommand::class))->getNamespaceName(), "exec");
        $exec->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                $this->assertEquals("docker push nginx:latest", $command);
                $output = ["image was created"];
                $return_var = 0;
            }
        );

        $nginxTag = new Tag('nginx');
        $cmd = new PushImageCommand($nginxTag);
        $cmd->execute();
    }

    public function testPushImageFailure() {
        $exec = $this->getFunctionMock((new \ReflectionClass(PushImageCommand::class))->getNamespaceName(), "exec");
        $exec->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                $output = ["image not pushed"];
                $return_var = 1;
            }
        );

        $this->expectException(ExecutionCommandException::class);

        $nginxTag = new Tag('nginx');
        $cmd = new PushImageCommand($nginxTag);
        $cmd->execute();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 18:21
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\ExecutionCommand;


use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\BuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Exceptions\ExecutionCommandException;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use phpmock\phpunit\PHPMock;

class BuildImageCommandTest extends \PHPUnit_Framework_TestCase
{

    use PHPMock;

    public function testCommandWithOneTag()
    {
        $exec = $this->getFunctionMock((new \ReflectionClass(BuildImageCommand::class))->getNamespaceName(), "exec");
        $exec->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                static::assertStringStartsWith('docker build', $command);
                static::assertContains('-t nginx:latest', $command);
                static::assertContains('-f Dockerfile', $command);
                static::assertStringEndsWith('.', $command);
                $output = ["image was created"];
                $return_var = 0;
            }
        );

        $nginxTag = new Tag('nginx');
        $cmd = new BuildImageCommand('Dockerfile', '.', [$nginxTag]);
        $cmd->execute();
    }

    public function testCommandWithManyTag()
    {

        $exec = $this->getFunctionMock((new \ReflectionClass(BuildImageCommand::class))->getNamespaceName(), "exec");
        $exec->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                static::assertContains('-t nginx:latest', $command);
                static::assertContains('-t nginx:1.0', $command);
                $output = ["image was created"];
                $return_var = 0;
            }
        );

        $nginxTag = [new Tag('nginx', 'latest'), new Tag('nginx', '1.0')];
        $cmd = new BuildImageCommand('Dockerfile', '.', $nginxTag);
        $cmd->execute();
    }


    public function testCommandWithReturningNotZeroCode()
    {
        $exec = $this->getFunctionMock((new \ReflectionClass(BuildImageCommand::class))->getNamespaceName(), "exec");
        $exec->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                $output = ["image creating failure"];
                $return_var = 1;
            }
        );
        $this->expectException(ExecutionCommandException::class);


        $nginxTag = [new Tag('nginx', 'latest'), new Tag('nginx', '1.0')];
        $cmd = new BuildImageCommand('Dockerfile', '.', $nginxTag);
        $cmd->execute();
    }
}

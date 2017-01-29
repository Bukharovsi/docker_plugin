<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 22.01.17
 * Time: 18:16
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Image;


use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ManualConfiguration;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\BuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\PushImageCommand;
use Bukharovsi\DockerPlugin\Docker\Image\DockerImage;
use phpDocumentor\Reflection\Types\This;
use phpmock\phpunit\PHPMock;

class DockerImageTest extends \PHPUnit_Framework_TestCase
{
    use PHPMock;

    public function testImageBuild()
    {
        $exec = $this->getFunctionMock((new \ReflectionClass(BuildImageCommand::class))->getNamespaceName(), "exec");
        $exec->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                static::assertStringStartsWith('docker build', $command);
                static::assertContains('-t nginx:latest', $command);
                static::assertContains('-f Dockerfile', $command);
                static::assertStringEndsWith('.', $command);;
                $output = ["image created seccessfully"];
                $return_var = 0;
            }
        );

        $configuration = new ManualConfiguration('nginx');
        $image = new DockerImage($configuration, new ConsoleCommandBuilder());

        $image->build();
    }

    public function testImagePush()
    {
        $exec = $this->getFunctionMock((new \ReflectionClass(PushImageCommand::class))->getNamespaceName(), "exec");
        $exec->expects($this->once())->willReturnCallback(
            function ($command, &$output, &$return_var) {
                static::assertStringStartsWith('docker push', $command);
                static::assertContains('nginx:latest', $command);
                $output = ["image pushed seccessfully"];
                $return_var = 0;
            }
        );

        $configuration = new ManualConfiguration('nginx');
        $image = new DockerImage($configuration, new ConsoleCommandBuilder());

        $image->push();
    }

}

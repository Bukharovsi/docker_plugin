<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 22.01.17
 * Time: 18:16
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Image;


use AdamBrett\ShellWrapper\Runners\FakeRunner;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ManualConfiguration;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\BuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\PushImageCommand;
use Bukharovsi\DockerPlugin\Docker\Image\DockerImage;
use phpmock\phpunit\PHPMock;

class DockerImageTest extends \PHPUnit_Framework_TestCase
{
    use PHPMock;

    public function testImageBuild()
    {
        $fakeRunner = new FakeRunner();
        $configuration = new ManualConfiguration('nginx');
        $image = new DockerImage($configuration, new ConsoleCommandBuilder($fakeRunner));
        $image->build();

        static::assertStringStartsWith('docker build', $fakeRunner->getExecutedCommand());
        static::assertContains('-t nginx:latest', $fakeRunner->getExecutedCommand());
        static::assertContains('-f Dockerfile', $fakeRunner->getExecutedCommand());
        static::assertStringEndsWith('.', $fakeRunner->getExecutedCommand());
    }

    public function testImagePush()
    {
        $fakeRunner = new FakeRunner();
        $configuration = new ManualConfiguration('nginx');
        $image = new DockerImage($configuration, new ConsoleCommandBuilder($fakeRunner));
        $image->push();

        static::assertStringStartsWith('docker push', $fakeRunner->getExecutedCommand());
        static::assertContains('nginx:latest', $fakeRunner->getExecutedCommand());
    }

}

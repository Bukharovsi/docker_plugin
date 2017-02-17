<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Image;

use AdamBrett\ShellWrapper\Runners\FakeRunner;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ManualConfiguration;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Image\DockerImage;

class DockerImageTest extends \PHPUnit_Framework_TestCase
{
    public function testImageBuild()
    {
        $fakeRunner = new FakeRunner();
        $configuration = new ManualConfiguration('nginx');
        $image = new DockerImage($configuration, new ConsoleCommandBuilder($fakeRunner));
        $image->build();

        static::assertStringStartsWith('docker build', $fakeRunner->getExecutedCommand());
        static::assertContains("--tag 'nginx:latest'", $fakeRunner->getExecutedCommand());
        static::assertContains("--file 'Dockerfile'", $fakeRunner->getExecutedCommand());
        static::assertStringEndsWith("'.'", $fakeRunner->getExecutedCommand());
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

<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 18:21
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\ExecutionCommand;


use AdamBrett\ShellWrapper\ExitCodes;
use AdamBrett\ShellWrapper\Runners\FakeRunner;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Exceptions\ExecutionCommandException;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\BuildImageCommand;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;

class BuildImageCommandTest extends \PHPUnit_Framework_TestCase
{

    public function testCommandWithOneTag()
    {
        $fakeRunner = new FakeRunner();

        $nginxTag = new Tag('nginx');
        $cmd = new BuildImageCommand($fakeRunner, 'Dockerfile', '.', [$nginxTag]);
        $cmd->execute();

        static::assertStringStartsWith('docker build', $fakeRunner->getExecutedCommand());
        static::assertContains("--tag 'nginx:latest'", $fakeRunner->getExecutedCommand());
        static::assertContains("-file 'Dockerfile'", $fakeRunner->getExecutedCommand());
        static::assertStringEndsWith("'.'", $fakeRunner->getExecutedCommand());

    }

    public function testCommandWithManyTag()
    {
        $fakeRunner = new FakeRunner();

        $nginxTag = [new Tag('nginx', 'latest'), new Tag('nginx', '1.0')];
        $cmd = new BuildImageCommand($fakeRunner, 'Dockerfile', '.', $nginxTag);
        $cmd->execute();

        static::assertContains("--tag 'nginx:latest'", $fakeRunner->getExecutedCommand());
        static::assertContains("--tag 'nginx:1.0'", $fakeRunner->getExecutedCommand());
    }


    public function testCommandWithReturningNotZeroCode()
    {
        $outputMsg = 'something strange occurred';
        $fakeRunner = new FakeRunner(ExitCodes::FATAL_ERROR_END, $outputMsg);

        $this->expectException(ExecutionCommandException::class);
        static::expectExceptionMessageRegExp("/.*$outputMsg.*/");

        $nginxTag = [new Tag('nginx', 'latest'), new Tag('nginx', '1.0')];
        $cmd = new BuildImageCommand($fakeRunner, 'Dockerfile', '.', $nginxTag);
        $cmd->execute();
    }
}

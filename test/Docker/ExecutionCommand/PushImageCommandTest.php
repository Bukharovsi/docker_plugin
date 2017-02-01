<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 20:05
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\ExecutionCommand;


use AdamBrett\ShellWrapper\ExitCodes;
use AdamBrett\ShellWrapper\Runners\FakeRunner;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Exceptions\ExecutionCommandException;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\PushImageCommand;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use phpmock\phpunit\PHPMock;

class PushImageCommandTest extends \PHPUnit_Framework_TestCase
{
    use PHPMock;

    public function testPushImage() {
        $fakeRunner = new FakeRunner();
        $nginxTag = new Tag('nginx');
        $cmd = new PushImageCommand($fakeRunner, $nginxTag);
        $cmd->execute();

        static::assertEquals("docker push nginx:latest", $fakeRunner->getExecutedCommand());
    }

    public function testPushImageFailure() {
        $errMsg = 'image has not pushed';
        $fakeRunner = new FakeRunner(ExitCodes::FATAL_ERROR_END, $errMsg);
        $this->expectException(ExecutionCommandException::class);
        static::expectExceptionMessageRegExp("/.*$errMsg.*/");

        $nginxTag = new Tag('nginx');
        $cmd = new PushImageCommand($fakeRunner, $nginxTag);
        $cmd->execute();
    }
}

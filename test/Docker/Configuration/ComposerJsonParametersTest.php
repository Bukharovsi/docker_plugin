<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 10:49
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\ComposerJsonParameters;
use Bukharovsi\DockerPlugin\Docker\Configuration\DefaultCommandParameters;
use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;

class ComposerJsonParametersTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyJsonConfig() {
        $jsonConfig = [
            'docker' => [
            ]
        ];
        $default = new DefaultCommandParameters();
        $param = new ComposerJsonParameters($jsonConfig);

        $this->expectException(DefaultCommandParametersOverridingException::class);
        $this->assertEquals($default->imageName(), $param->imageName());
        $this->assertEquals($default->imageTag(), $param->imageTag());
        $this->assertEquals($default->dockerFilePath(), $param->dockerFilePath());
        $this->assertEquals($default->workingDirectory(), $param->workingDirectory());
    }

    public function testSetImageName() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx'
            ]
        ];
        $default = new DefaultCommandParameters();
        $param = new ComposerJsonParameters($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals($default->imageTag(), $param->imageTag());
        $this->assertEquals($default->dockerFilePath(), $param->dockerFilePath());
        $this->assertEquals($default->workingDirectory(), $param->workingDirectory());
    }

    public function testSetImageTag() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx',
                'tag' => '1.0'
            ]
        ];
        $default = new DefaultCommandParameters();
        $param = new ComposerJsonParameters($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals('1.0', $param->imageTag());
        $this->assertEquals($default->dockerFilePath(), $param->dockerFilePath());
        $this->assertEquals($default->workingDirectory(), $param->workingDirectory());
    }

    public function testSetDockerfile() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx',
                'tag' => '1.0',
                'dockerfile' => 'docker_override'
            ]
        ];
        $default = new DefaultCommandParameters();
        $param = new ComposerJsonParameters($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals('1.0', $param->imageTag());
        $this->assertEquals('docker_override', $param->dockerFilePath());
        $this->assertEquals($default->workingDirectory(), $param->workingDirectory());
    }

    public function testSetWorkdir() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx',
                'tag' => '1.0',
                'dockerfile' => 'docker_override',
                'workingdirectory' => '/tmp'
            ]
        ];
        $param = new ComposerJsonParameters($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals('1.0', $param->imageTag());
        $this->assertEquals('docker_override', $param->dockerFilePath());
        $this->assertEquals('/tmp', $param->workingDirectory());
    }
}

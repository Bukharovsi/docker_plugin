<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 10:49
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\ComposerJsonConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\DefaultConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;

class ComposerJsonParametersTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyJsonConfig() {
        $jsonConfig = [
            'docker' => [
            ]
        ];
        $default = new DefaultConfiguration();
        $param = new ComposerJsonConfiguration($jsonConfig);

        $this->expectException(DefaultCommandParametersOverridingException::class);
        $this->assertEquals($default->imageName(), $param->imageName());
        $this->assertEquals($default->imageTags(), $param->imageTags());
        $this->assertEquals($default->dockerFilePath(), $param->dockerFilePath());
        $this->assertEquals($default->workingDirectory(), $param->workingDirectory());
    }

    public function testSetImageName() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx'
            ]
        ];
        $default = new DefaultConfiguration();
        $param = new ComposerJsonConfiguration($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals($default->imageTags(), $param->imageTags());
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
        $default = new DefaultConfiguration();
        $param = new ComposerJsonConfiguration($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals(['1.0'], $param->imageTags());
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
        $default = new DefaultConfiguration();
        $param = new ComposerJsonConfiguration($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals(['1.0'], $param->imageTags());
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
        $param = new ComposerJsonConfiguration($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertEquals(['1.0'], $param->imageTags());
        $this->assertEquals('docker_override', $param->dockerFilePath());
        $this->assertEquals('/tmp', $param->workingDirectory());
    }

    public function testTagAsArray() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx',
                'tag' => ['1.0', 'latest'],
            ]
        ];
        $param = new ComposerJsonConfiguration($jsonConfig);

        $this->assertEquals('nginx', $param->imageName());
        $this->assertSame(['1.0', 'latest'], $param->imageTags());
    }
}

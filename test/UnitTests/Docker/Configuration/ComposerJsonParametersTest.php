<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ComposerJsonConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\DefaultConfiguration;

class ComposerJsonParametersTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyJsonConfig() {
        $jsonConfig = [
            'docker' => [
            ]
        ];
        $default = new DefaultConfiguration();
        $param = new ComposerJsonConfiguration($jsonConfig);

        static::expectException(DefaultCommandParametersOverridingException::class);
        static::assertEquals($default->imageName(), $param->imageName());
        static::assertEquals($default->imageTags(), $param->imageTags());
        static::assertEquals($default->dockerFilePath(), $param->dockerFilePath());
        static::assertEquals($default->workingDirectory(), $param->workingDirectory());
        static::assertEquals($default->reports(), $param->reports());
        static::assertEquals($default->outputReportPath(), $param->outputReportPath());
    }

    public function testSetImageName() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx'
            ]
        ];
        $default = new DefaultConfiguration();
        $param = new ComposerJsonConfiguration($jsonConfig);

        static::assertEquals('nginx', $param->imageName());
        static::assertEquals($default->imageTags(), $param->imageTags());
        static::assertEquals($default->dockerFilePath(), $param->dockerFilePath());
        static::assertEquals($default->workingDirectory(), $param->workingDirectory());
        static::assertEquals($default->reports(), $param->reports());
        static::assertEquals($default->outputReportPath(), $param->outputReportPath());
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

        static::assertEquals('nginx', $param->imageName());
        static::assertEquals(['1.0'], $param->imageTags());
        static::assertEquals($default->dockerFilePath(), $param->dockerFilePath());
        static::assertEquals($default->workingDirectory(), $param->workingDirectory());
        static::assertEquals($default->reports(), $param->reports());
        static::assertEquals($default->outputReportPath(), $param->outputReportPath());
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

        static::assertEquals('nginx', $param->imageName());
        static::assertEquals(['1.0'], $param->imageTags());
        static::assertEquals('docker_override', $param->dockerFilePath());
        static::assertEquals($default->workingDirectory(), $param->workingDirectory());
        static::assertEquals($default->reports(), $param->reports());
        static::assertEquals($default->outputReportPath(), $param->outputReportPath());
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
        $default = new DefaultConfiguration();
        $param = new ComposerJsonConfiguration($jsonConfig);

        static::assertEquals('nginx', $param->imageName());
        static::assertEquals(['1.0'], $param->imageTags());
        static::assertEquals('docker_override', $param->dockerFilePath());
        static::assertEquals('/tmp', $param->workingDirectory());
        static::assertEquals($default->reports(), $param->reports());
        static::assertEquals($default->outputReportPath(), $param->outputReportPath());
    }


    public function testDefiningReports()
    {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx',
                'reports' => ['teamcity'],
            ]
        ];
        $param = new ComposerJsonConfiguration($jsonConfig);

        static::assertEquals(['teamcity'], $param->reports());
    }

    public function testReportOutputDir()
    {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx',
                'reports' => ['teamcity'],
                ComposerJsonConfiguration::OUT_REPORT_PATH => '/tmp'
            ]
        ];
        $param = new ComposerJsonConfiguration($jsonConfig);

        static::assertEquals('/tmp', $param->outputReportPath());
    }

    public function testTagAsArray() {
        $jsonConfig = [
            'docker' => [
                'name' => 'nginx',
                'tag' => ['1.0', 'latest'],
            ]
        ];
        $param = new ComposerJsonConfiguration($jsonConfig);

        static::assertEquals('nginx', $param->imageName());
        static::assertSame(['1.0', 'latest'], $param->imageTags());
    }
}

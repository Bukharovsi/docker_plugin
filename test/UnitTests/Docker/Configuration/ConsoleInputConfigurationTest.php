<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\DefaultConfiguration;
use Symfony\Component\Console\Input\StringInput;

class ConsoleInputConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testAllParamsAreDefaults() {
        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        static::expectException(DefaultCommandParametersOverridingException::class);
        $cmdParams->imageName();
    }

    public function testDefiningImageName() {
        $input = new StringInput('--name nginx');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $defaultParameters = new DefaultConfiguration();
        static::assertEquals("nginx", $cmdParams->imageName());
        static::assertEquals($defaultParameters->imageTags(), $cmdParams->imageTags());
    }

    public function testDefiningImageTag() {
        $input = new StringInput('--name nginx --tag latest');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $defaultParameters = new DefaultConfiguration();
        static::assertEquals("nginx", $cmdParams->imageName());
        static::assertEquals(['latest'], $cmdParams->imageTags());
        static::assertEquals($defaultParameters->dockerFilePath(), $cmdParams->dockerFilePath());
    }

    public function testDefiningDockerFile() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $defaultParameters = new DefaultConfiguration();
        static::assertEquals('nginx', $cmdParams->imageName());
        static::assertEquals(['latest'], $cmdParams->imageTags());
        static::assertEquals('Dockerfile_new', $cmdParams->dockerFilePath());
        static::assertEquals($defaultParameters->workingDirectory(), $cmdParams->workingDirectory());
        static::assertEquals($defaultParameters->reports(), $cmdParams->reports());
    }

    public function testDefiningAllParams() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new --workingdirectory /tmp --report teamcity');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        static::assertEquals("nginx", $cmdParams->imageName());
        static::assertEquals(["latest"], $cmdParams->imageTags());
        static::assertEquals("Dockerfile_new", $cmdParams->dockerFilePath());
        static::assertEquals('/tmp', $cmdParams->workingDirectory());
        static::assertEquals(['teamcity'], $cmdParams->reports());
    }

    public function testDefiningReportOutputDir() {
        $input = new StringInput('--out-report-path /home/jhon');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        static::assertEquals('/home/jhon', $cmdParams->outputReportPath());
    }
}

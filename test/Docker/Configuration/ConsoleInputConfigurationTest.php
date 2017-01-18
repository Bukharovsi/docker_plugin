<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 0:18
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\DefaultConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;
use Bukharovsi\DockerPlugin\Docker\Configuration\ConsoleInputConfiguration;
use Symfony\Component\Console\Input\StringInput;

class ConsoleInputConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testAllParamsAreDefaults() {
        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $this->expectException(DefaultCommandParametersOverridingException::class);
        $cmdParams->imageName();
    }

    public function testOverridingImageName() {
        $input = new StringInput('--name nginx');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals($defaultParameters->imageTags(), $cmdParams->imageTags());
    }

    public function testOverridingImageTag() {
        $input = new StringInput('--name nginx --tag latest');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals($defaultParameters->dockerFilePath(), $cmdParams->dockerFilePath());
    }

    public function testOverridingDockerFile() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals('nginx', $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals('Dockerfile_new', $cmdParams->dockerFilePath());
        $this->assertEquals($defaultParameters->workingDirectory(), $cmdParams->workingDirectory());
    }

    public function testOverridingDefault() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new --workingdirectory /tmp');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());
        $cmdParams = new ConsoleInputConfiguration($input);

        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(["latest"], $cmdParams->imageTags());
        $this->assertEquals("Dockerfile_new", $cmdParams->dockerFilePath());
        $this->assertEquals('/tmp', $cmdParams->workingDirectory());
    }
}

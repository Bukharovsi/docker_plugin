<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 0:18
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\DefaultCommandParameters;
use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;
use Bukharovsi\DockerPlugin\Docker\Configuration\InputCommandParameters;
use Symfony\Component\Console\Input\StringInput;

class InputCommandParametersTest extends \PHPUnit_Framework_TestCase
{
    public function testAllParamsAreDefaults() {
        $input = new StringInput('');
        $input->bind(InputCommandParameters::createInputDefinition());
        $cmdParams = new InputCommandParameters($input);

        $this->expectException(DefaultCommandParametersOverridingException::class);
        $cmdParams->imageName();
    }

    public function testOverridingImageName() {
        $input = new StringInput('--name nginx');
        $input->bind(InputCommandParameters::createInputDefinition());
        $cmdParams = new InputCommandParameters($input);

        $defaultParameters = new DefaultCommandParameters();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals($defaultParameters->imageTag(), $cmdParams->imageTag());
    }

    public function testOverridingImageTag() {
        $input = new StringInput('--name nginx --tag latest');
        $input->bind(InputCommandParameters::createInputDefinition());
        $cmdParams = new InputCommandParameters($input);

        $defaultParameters = new DefaultCommandParameters();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTag());
        $this->assertEquals($defaultParameters->dockerFilePath(), $cmdParams->dockerFilePath());
    }

    public function testOverridingDockerFile() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new');
        $input->bind(InputCommandParameters::createInputDefinition());
        $cmdParams = new InputCommandParameters($input);

        $defaultParameters = new DefaultCommandParameters();
        $this->assertEquals('nginx', $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTag());
        $this->assertEquals('Dockerfile_new', $cmdParams->dockerFilePath());
        $this->assertEquals($defaultParameters->workingDirectory(), $cmdParams->workingDirectory());
    }

    public function testOverridingDefault() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new --workingdirectory /tmp');
        $input->bind(InputCommandParameters::createInputDefinition());
        $cmdParams = new InputCommandParameters($input);

        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(["latest"], $cmdParams->imageTag());
        $this->assertEquals("Dockerfile_new", $cmdParams->dockerFilePath());
        $this->assertEquals('/tmp', $cmdParams->workingDirectory());
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:28
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\CommandParameters;
use Bukharovsi\DockerPlugin\Docker\Configuration\DefaultCommandParameters;
use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;

/**
 * Class CommandParametersTest
 * @package Bukharovsi\DockerPlugin\Test\Docker\Configuration
 */
class CommandParametersTest extends \PHPUnit_Framework_TestCase
{

    public function testAllParamsAreDefaults() {
        $cmdParams = new CommandParameters();

        $this->expectException(DefaultCommandParametersOverridingException::class);
        $cmdParams->imageName();
    }

    public function testOverridingImageName() {
        $cmdParams = new CommandParameters('nginx');

        $defaultParameters = new DefaultCommandParameters();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals($defaultParameters->imageTags(), $cmdParams->imageTags());
    }

    public function testOverridingImageTag() {
        $cmdParams = new CommandParameters('nginx', 'latest');

        $defaultParameters = new DefaultCommandParameters();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals($defaultParameters->dockerFilePath(), $cmdParams->dockerFilePath());
    }

    public function testOverridingDockerFile() {
        $cmdParams = new CommandParameters('nginx', 'latest', 'Dockerfile_new');

        $defaultParameters = new DefaultCommandParameters();
        $this->assertEquals('nginx', $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals('Dockerfile_new', $cmdParams->dockerFilePath());
        $this->assertEquals($defaultParameters->workingDirectory(), $cmdParams->workingDirectory());
    }

    public function testOverridingDefault() {
        $cmdParams = new CommandParameters("nginx", "dev", "Dockerfile_new", '/tmp');

        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(["dev"], $cmdParams->imageTags());
        $this->assertEquals("Dockerfile_new", $cmdParams->dockerFilePath());
        $this->assertEquals('/tmp', $cmdParams->workingDirectory());
    }
}

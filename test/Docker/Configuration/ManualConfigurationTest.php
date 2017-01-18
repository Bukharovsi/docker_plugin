<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:28
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\ManualConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\DefaultConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Exceptions\DefaultCommandParametersOverridingException;

/**
 * Class CommandParametersTest
 * @package Bukharovsi\DockerPlugin\Test\Docker\Configuration
 */
class ManualConfigurationTest extends \PHPUnit_Framework_TestCase
{

    public function testAllParamsAreDefaults() {
        $cmdParams = new ManualConfiguration();

        $this->expectException(DefaultCommandParametersOverridingException::class);
        $cmdParams->imageName();
    }

    public function testOverridingImageName() {
        $cmdParams = new ManualConfiguration('nginx');

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals($defaultParameters->imageTags(), $cmdParams->imageTags());
    }

    public function testOverridingImageTag() {
        $cmdParams = new ManualConfiguration('nginx', 'latest');

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals($defaultParameters->dockerFilePath(), $cmdParams->dockerFilePath());
    }

    public function testOverridingDockerFile() {
        $cmdParams = new ManualConfiguration('nginx', 'latest', 'Dockerfile_new');

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals('nginx', $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals('Dockerfile_new', $cmdParams->dockerFilePath());
        $this->assertEquals($defaultParameters->workingDirectory(), $cmdParams->workingDirectory());
    }

    public function testOverridingDefault() {
        $cmdParams = new ManualConfiguration("nginx", "dev", "Dockerfile_new", '/tmp');

        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(["dev"], $cmdParams->imageTags());
        $this->assertEquals("Dockerfile_new", $cmdParams->dockerFilePath());
        $this->assertEquals('/tmp', $cmdParams->workingDirectory());
    }
}

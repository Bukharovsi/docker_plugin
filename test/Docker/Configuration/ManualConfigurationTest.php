<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 16.01.17
 * Time: 23:28
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ManualConfiguration;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\DefaultConfiguration;
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

    public function testDefiningImageName() {
        $cmdParams = new ManualConfiguration('nginx');

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals($defaultParameters->imageTags(), $cmdParams->imageTags());
    }

    public function testDefiningImageTag() {
        $cmdParams = new ManualConfiguration('nginx', 'latest');

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals("nginx", $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals($defaultParameters->dockerFilePath(), $cmdParams->dockerFilePath());
    }

    public function testDefiningDockerFile() {
        $cmdParams = new ManualConfiguration('nginx', 'latest', 'Dockerfile_new');

        $defaultParameters = new DefaultConfiguration();
        $this->assertEquals('nginx', $cmdParams->imageName());
        $this->assertEquals(['latest'], $cmdParams->imageTags());
        $this->assertEquals('Dockerfile_new', $cmdParams->dockerFilePath());
        $this->assertEquals($defaultParameters->workingDirectory(), $cmdParams->workingDirectory());
    }


    public function testDefiningWorkingDirectory() {
        $cmdParams = new ManualConfiguration("nginx", "dev", "Dockerfile_new", '/tmp');

        static::assertEquals("nginx", $cmdParams->imageName());
        static::assertEquals(["dev"], $cmdParams->imageTags());
        static::assertEquals("Dockerfile_new", $cmdParams->dockerFilePath());
        static::assertEquals('/tmp', $cmdParams->workingDirectory());
    }

    public function testDefiningReports() {
        $cmdParams = new ManualConfiguration("nginx", "dev", "Dockerfile_new", '/tmp', ['teamcity']);

        static::assertEquals("nginx", $cmdParams->imageName());
        static::assertEquals(["dev"], $cmdParams->imageTags());
        static::assertEquals("Dockerfile_new", $cmdParams->dockerFilePath());
        static::assertEquals('/tmp', $cmdParams->workingDirectory());
        static::assertEquals(['teamcity'], $cmdParams->reports());
    }
}

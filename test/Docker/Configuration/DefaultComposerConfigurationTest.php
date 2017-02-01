<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 1:18
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\DefaultComposerConfiguration;
use Bukharovsi\DockerPlugin\Test\Docker\FakeObjects\RootPackageMockFactory;
use Composer\Package\RootPackageInterface;

class DefaultComposerConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testAllParams() {
        $params = new DefaultComposerConfiguration(RootPackageMockFactory::createMock('nginx', '1.0'));

        $this->assertEquals('nginx', $params->imageName());
        $this->assertEquals(['1.0'], $params->imageTags());
    }

    public function testOnlyName() {
        $params = new DefaultComposerConfiguration(RootPackageMockFactory::createMock('nginx', null));

        $this->assertEquals('nginx', $params->imageName());
        $this->assertEquals(['latest'], $params->imageTags());
    }
}

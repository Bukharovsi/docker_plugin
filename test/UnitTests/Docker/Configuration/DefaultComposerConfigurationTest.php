<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\DefaultComposerConfiguration;
use Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects\RootPackageMockFactory;
use Composer\Package\RootPackageInterface;

class DefaultComposerConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testAllParams() {
        $params = new DefaultComposerConfiguration(RootPackageMockFactory::createMock(
            'nginx',
            '1.0'
        ));

        static::assertEquals('nginx', $params->imageName());
        static::assertEquals(['1.0'], $params->imageTags());
    }

    public function testOnlyName() {
        $params = new DefaultComposerConfiguration(RootPackageMockFactory::createMock('nginx', null));

        static::assertEquals('nginx', $params->imageName());
        static::assertEquals(['latest'], $params->imageTags());
    }
}

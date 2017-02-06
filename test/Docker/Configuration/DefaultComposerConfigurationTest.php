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
        $params = new DefaultComposerConfiguration(RootPackageMockFactory::createMock(
            'nginx',
            '1.0',
            [],
            '/tmp'
        ));

        static::assertEquals('nginx', $params->imageName());
        static::assertEquals(['1.0'], $params->imageTags());
        static::assertEquals('/tmp/out', $params->outputReportPath());
    }

    public function testOnlyName() {
        $params = new DefaultComposerConfiguration(RootPackageMockFactory::createMock('nginx', null));

        static::assertEquals('nginx', $params->imageName());
        static::assertEquals(['latest'], $params->imageTags());
    }
}

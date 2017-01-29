<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 0:53
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\StringInput;

class ConfiguratorTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultBuilder() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        $package = $this->getRootPackageMock('nginx', '1.0', []);
        $builder = new ComposerProjectConfigurator($package);
        $configuration = $builder->makeConfiguration($input);

        $this->assertEquals('nginx', $configuration->imageName(), 'image name is provided by command line. Hegher order');
        $this->assertEquals(['latest'], $configuration->imageTags());
        $this->assertEquals('Dockerfile_new', $configuration->dockerFilePath());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRootPackageMock($name, $version, $extra)
    {
        $package = $this->getMockBuilder(RootPackageInterface::class)
            ->setMethods(['getName', 'getVersion', 'getExtra'])
            ->getMock();
        $package->method('getName')->willReturn($name);
        $package->method('getVersion')->willReturn($version);
        $package->method('getExtra')->willReturn($extra);
        return $package;
    }
}

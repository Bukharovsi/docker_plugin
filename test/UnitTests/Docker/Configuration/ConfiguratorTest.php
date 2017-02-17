<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects\RootPackageMockFactory;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\StringInput;

class ConfiguratorTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultBuilder() {
        $input = new StringInput('--name nginx --tag latest --dockerfile Dockerfile_new');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        $package = RootPackageMockFactory::createMock('nginx', '1.0', [], '/tmp');
        $builder = new ComposerProjectConfigurator($package);
        $configuration = $builder->makeConfiguration($input);

        $this->assertEquals('nginx', $configuration->imageName(), 'image name is provided by command line. Hegher order');
        $this->assertEquals(['latest'], $configuration->imageTags());
        $this->assertEquals('Dockerfile_new', $configuration->dockerFilePath());
    }

}

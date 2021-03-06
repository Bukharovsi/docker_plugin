<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects;

use Composer\Package\RootPackageInterface;

class RootPackageMockFactory
{
    public static function createMock($name, $version = null, $extra = [], $targetDir = null)
    {
        $mock = \Mockery::mock(RootPackageInterface::class)
            ->shouldReceive('getName')
                ->andReturn($name)
            ->shouldReceive('getVersion')
                ->andReturn($version)
            ->shouldReceive('getExtra')
                ->andReturn($extra)
            ->mock();

        return $mock;
    }
}

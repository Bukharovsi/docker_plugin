<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 08.09.16
 * Time: 14:28
 */

namespace Bukharovsi\Tests\Docker;


use Bukharovsi\DockerPlugin\Docker\DockerCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Tag\Tag;

class DockerCommandBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildingSimplestCommand()
    {
        $builder = new DockerCommandBuilder();
        $dockerCommand = $builder->buildCommand();

        static::assertStringStartsWith('docker build', $dockerCommand);
    }

    public function testSpecifyWorkingDirectory()
    {
        $builder = new DockerCommandBuilder();
        $builder->specifyWorkingDirectory('/tmp');
        $dockerCommand = $builder->buildCommand();

        static::assertEquals('docker build /tmp', $dockerCommand);
    }

    public function testAddOneTag()
    {
        $builder = new DockerCommandBuilder();
        $builder->addTag(new Tag('my_project', 'latest'));
        $dockerCommand = $builder->buildCommand();

        static::assertStringStartsWith('docker build -tmy_project:latest', $dockerCommand);
    }

    public function testAddTwoTags()
    {
        $builder = new DockerCommandBuilder();
        $dockerCommand = $builder
            ->addTag(new Tag('my_project', 'latest'))
            ->addTag(new Tag('my_project', '9.0'))
            ->buildCommand();

        static::assertStringStartsWith('docker build -tmy_project:latest -tmy_project:9.0', $dockerCommand);
    }

    public function testSpecifyDockerfileTags()
    {
        $builder = new DockerCommandBuilder();
        $dockerCommand = $builder
            ->specifyDockerfile('Dockerfile.dev')
            ->buildCommand();

        static::assertStringStartsWith('docker build -fDockerfile.dev', $dockerCommand);
    }
}

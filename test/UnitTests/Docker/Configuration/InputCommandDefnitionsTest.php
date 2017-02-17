<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Configuration;

use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Symfony\Component\Console\Input\StringInput;

//use Symfony\Component\Console\Exception\InvalidArgumentException;

class InputCommandDefnitionsTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyCommand()
    {
        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        static::assertNull($input->getOption('name'));
    }

    public function testGettingNotDefinedArgument()
    {
        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        static::expectException(\Exception::class); //InvalidArgumentException
        $input->getOption('XXXXX');
    }

    public function testDefinitions()
    {
        $input = new StringInput('--name nginx --tag latest --dockerfile dockerfile --workingdirectory /tmp --report teamcity --out-report-path /home');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        static::assertEquals('nginx', $input->getOption('name'));
        static::assertEquals(['latest'], $input->getOption('tag'));
        static::assertEquals('dockerfile', $input->getOption('dockerfile'));
        static::assertEquals('/tmp', $input->getOption('workingdirectory'));
        static::assertEquals(['teamcity'], $input->getOption('report'));
        static::assertEquals('/home', $input->getOption('out-report-path'));
    }
}

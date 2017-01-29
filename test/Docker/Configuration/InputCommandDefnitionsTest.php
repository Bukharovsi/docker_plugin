<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 23:53
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StringInput;

class InputCommandDefnitionsTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyCommand() {
        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        static::assertNull($input->getOption('name'));
    }

    public function testGettingNotDefinedArgument() {
        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        static::expectException(InvalidArgumentException::class);
        $input->getOption('XXXXX');

    }

    public function testDefinitions() {
        $input = new StringInput('--name nginx --tag latest --dockerfile dockerfile --workingdirectory /tmp --report teamcity');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        static::assertEquals('nginx', $input->getOption('name'));
        static::assertEquals(['latest'], $input->getOption('tag'));
        static::assertEquals('dockerfile', $input->getOption('dockerfile'));
        static::assertEquals('/tmp', $input->getOption('workingdirectory'));
        static::assertEquals(['teamcity'], $input->getOption('report'));
    }
}

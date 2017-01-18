<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 17.01.17
 * Time: 23:53
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Configuration;


use Bukharovsi\DockerPlugin\Docker\Configuration\ConsoleInputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StringInput;

class InputCommandDefnitionsTest extends \PHPUnit_Framework_TestCase
{
    public function testDefinitions() {
        $input = new StringInput('--name nginx --tag latest --dockerfile dockerfile --workingdirectory /tmp');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        $this->assertEquals('nginx', $input->getOption('name'));
        $this->assertSame(['latest'], $input->getOption('tag'));
        $this->assertEquals('dockerfile', $input->getOption('dockerfile'));
        $this->assertEquals('/tmp', $input->getOption('workingdirectory'));
    }
}

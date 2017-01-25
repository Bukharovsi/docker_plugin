<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 25.01.17
 * Time: 15:53
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Report\Teamcity;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Image\Tag;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
use Symfony\Component\Console\Output\Output;

class TeamcityBuiltImageVersionReport extends \PHPUnit_Framework_TestCase
{
    public function testReport()
    {
        $builtImage = new BuiltImage([new Tag('nginx', '2.1'), new Tag('nginx', 'latest')]);
        $output = new TestOutput();
        $report = new TeamcityBuiltImageVersionReport($builtImage, $output, new TeamcityVariableCollection());

        $report->make();
        static::assertContains('##teamcity[setParameter name=\'env.BuildTag\'', $output->output);
        static::assertContains('value=\'2.1\'', $output->output);
        static::assertContains('##teamcity[setParameter name=\'env.BuildTag.1\'', $output->output);
        static::assertContains('value=\'latest\'', $output->output);
    }
}

class TestOutput extends Output
{
    public $output = '';

    public function clear()
    {
        $this->output = '';
    }

    protected function doWrite($message, $newline)
    {
        $this->output .= $message.($newline ? "\n" : '');
    }
}


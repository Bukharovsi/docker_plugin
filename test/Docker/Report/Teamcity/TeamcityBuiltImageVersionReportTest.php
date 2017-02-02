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
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityBuiltImageVersionReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
use Bukharovsi\DockerPlugin\Test\Docker\FakeObjects\FakeOutput;

class TeamcityBuiltImageVersionReportTest extends \PHPUnit_Framework_TestCase
{
    public function testReport()
    {
        $builtImage = new BuiltImage([new Tag('nginx', '2.1'), new Tag('nginx', 'latest')]);
        $report = new TeamcityBuiltImageVersionReport(new TeamcityVariableCollection());

        $reportOutput = $report->make($builtImage);
        static::assertContains('##teamcity[setParameter name=\'env.BuildTag\'', $reportOutput);
        static::assertContains('value=\'2.1\'', $reportOutput);
        static::assertContains('##teamcity[setParameter name=\'env.BuildTag.1\'', $reportOutput);
        static::assertContains('value=\'latest\'', $reportOutput);
    }
}



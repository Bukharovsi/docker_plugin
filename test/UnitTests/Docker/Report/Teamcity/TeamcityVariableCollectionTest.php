<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 25.01.17
 * Time: 15:21
 */

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\Report\Teamcity;

use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;

class TeamcityVariableCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetExistens()
    {
        $tcVariables = new TeamcityVariableCollection();
        static::assertEquals('env.BuildTag', $tcVariables->next());
        static::assertStringStartsWith('env.BuildTag', $tcVariables->next());
        static::assertStringStartsWith('env.BuildTag', $tcVariables->next());
        static::assertStringStartsWith('env.BuildTag', $tcVariables->next());
    }
}

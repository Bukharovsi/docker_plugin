<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 30.01.17
 * Time: 0:00
 */

namespace Bukharovsi\DockerPlugin\Test\Integration;


use AdamBrett\ShellWrapper\Runners\FakeRunner;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Report\ReportFullCollection;

class DockerImageBuilderApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testAppWithComposerConfiguration()
    {
//        $app = new DockerImageBuilderApplication(
//            new ConsoleCommandBuilder(
//                new FakeRunner()
//            ),
//            new ComposerProjectConfigurator($rootPackage),
//            new ReportFullCollection()
//        );
//
//        $app->buildDockerImage($input, $output);
    }

}

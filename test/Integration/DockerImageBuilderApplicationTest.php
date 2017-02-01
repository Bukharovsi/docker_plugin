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
use Bukharovsi\DockerPlugin\Test\Docker\FakeObjects\FakeOutput;
use Bukharovsi\DockerPlugin\Test\Docker\FakeObjects\RootPackageMockFactory;
use Symfony\Component\Console\Input\StringInput;

class DockerImageBuilderApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testAppWithComposerConfiguration()
    {
        $app = new DockerImageBuilderApplication(
            new ConsoleCommandBuilder(
                new FakeRunner()
            ),
            new ComposerProjectConfigurator(RootPackageMockFactory::createMock('nginx', '1.0')),
            new ReportFullCollection()
        );

        $input = new StringInput('app\console docker:build --name nginx');
        $output = new FakeOutput();
        $app->buildDockerImage($input, $output);
    }

}

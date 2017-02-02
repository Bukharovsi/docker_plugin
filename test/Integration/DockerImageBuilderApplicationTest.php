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
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Report\LogOutputReport;
use Bukharovsi\DockerPlugin\Docker\Report\PrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\ReportFullCollection;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityBuiltImageVersionReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
use Bukharovsi\DockerPlugin\Test\Docker\FakeObjects\FakeOutput;
use Bukharovsi\DockerPlugin\Test\Docker\FakeObjects\RootPackageMockFactory;
use Symfony\Component\Console\Input\StringInput;

class DockerImageBuilderApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testAppWithMinimumParams()
    {
        $runner = new FakeRunner();
        $app = new DockerImageBuilderApplication(
            new ConsoleCommandBuilder(
                $runner
            ),
            new ComposerProjectConfigurator(RootPackageMockFactory::createMock('nginx', '1.0')),
            new ReportFullCollection([
                new PrintableReport(new LogOutputReport()),
                new PrintableReport(new TeamcityBuiltImageVersionReport(new TeamcityVariableCollection()))
                ])
        );

        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        $output = new FakeOutput();
        $app->buildDockerImage($input, $output);

        static::assertEquals("docker build --tag 'nginx:1.0' --file 'Dockerfile' '.'", $runner->getExecutedCommand());
        static::assertContains('##teamcity[setParameter name=\'env.BuildTag\' value=\'1.0\']', $output->output);
    }

    public function testAppGetInfoFromComposerJson()
    {
        $dockerJsonExtra = [
            'docker' => [
                'name' => 'my_pet_project',
                'tag' => ['1.0', 'latest'],
                'dockerfile' => 'Dockerfile.my',
                'workingdirectory' => './api'
            ]
        ];

        $runner = new FakeRunner();
        $app = new DockerImageBuilderApplication(
            new ConsoleCommandBuilder(
                $runner
            ),
            new ComposerProjectConfigurator(RootPackageMockFactory::createMock('nginx', '1.0', $dockerJsonExtra)),
            new ReportFullCollection()
        );

        $input = new StringInput('');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        $output = new FakeOutput();
        $app->buildDockerImage($input, $output);

        static::assertEquals("docker build --tag 'my_pet_project:1.0' --tag 'my_pet_project:latest' --file 'Dockerfile.my' './api'", $runner->getExecutedCommand());
    }

    public function testAppGetInfoFromInput()
    {
        $runner = new FakeRunner();
        $app = new DockerImageBuilderApplication(
            new ConsoleCommandBuilder(
                $runner
            ),
            new ComposerProjectConfigurator(RootPackageMockFactory::createMock('nginx', '1.0')),
            new ReportFullCollection()
        );

        $input = new StringInput('--name=my_pet_project --dockerfile=Dockerfile.my');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        $output = new FakeOutput();
        $app->buildDockerImage($input, $output);

        static::assertEquals("docker build --tag 'my_pet_project:1.0' --file 'Dockerfile.my' '.'", $runner->getExecutedCommand());
    }



}

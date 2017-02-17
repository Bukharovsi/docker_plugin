<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 06.02.17
 * Time: 14:54
 */

namespace Bukharovsi\DockerPlugin\Test\Integration;


use AdamBrett\ShellWrapper\Runners\FakeRunner;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ComposerProjectConfigurator;
use Bukharovsi\DockerPlugin\Docker\Configuration\Impl\ConsoleInputConfiguration;
use Bukharovsi\DockerPlugin\Docker\DockerImageBuilderApplication;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ShellImpl\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Report\Html\HTMLReport;
use Bukharovsi\DockerPlugin\Docker\Report\PrintableReport;
use Bukharovsi\DockerPlugin\Docker\Report\ReportFullCollection;
use Bukharovsi\DockerPlugin\Docker\Report\SavableReport;
use Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects\FakeOutput;
use Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects\RootPackageMockFactory;
use Bukharovsi\DockerPlugin\Test\Helpers\DirectoryRecursiveRemover;
use League\Plates\Engine;
use Symfony\Component\Console\Input\StringInput;

class HtmlReportTest extends \PHPUnit_Framework_TestCase
{
    private function outputReportDirectory()
    {
        return  sys_get_temp_dir().DIRECTORY_SEPARATOR.'docker-plugin-test'.DIRECTORY_SEPARATOR . 'out';
    }

    public function testGeneratingHtmlReport()
    {
        // check output directory dont exist
        static::assertFalse(is_dir($this->outputReportDirectory().DIRECTORY_SEPARATOR));

        $runner = new FakeRunner();
        $app = new DockerImageBuilderApplication(
            new ConsoleCommandBuilder(
                $runner
            ),
            new ComposerProjectConfigurator(RootPackageMockFactory::createMock(
                'nginx',
                '1.0',
                ['docker' => ['out-report-path' => $this->outputReportDirectory()]]
            )),
            new ReportFullCollection([
                'BuiltImageHtmlReport' => new SavableReport(new HTMLReport(new Engine(HTMLReport::$REPORT_TEMPLATE_PATH)))
            ])
        );

        $input = new StringInput('--tag latest --tag 1.0');
        $input->bind(ConsoleInputConfiguration::createInputDefinition());

        $output = new FakeOutput();
        $app->buildDockerImage($input, $output);


        $reportFilePath = $this->outputReportDirectory(). DIRECTORY_SEPARATOR.'BuiltImageHtmlReport.html';
        static::assertTrue(is_dir($this->outputReportDirectory()));
        static::assertFileExists($reportFilePath);

        $generatedHtmlReport = file_get_contents($reportFilePath);

        static::assertContains('nginx:latest', $generatedHtmlReport);
        static::assertContains('nginx:1.0', $generatedHtmlReport);
    }

    protected function tearDown()
    {
        DirectoryRecursiveRemover::rrmdir($this->outputReportDirectory());
        parent::tearDown();
    }


}

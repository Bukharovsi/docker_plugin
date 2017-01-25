<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 24.01.17
 * Time: 21:46
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Teamcity;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\IReport;
use Bukharovsi\DockerPlugin\Docker\Report\Teamcity\TeamcityVariableCollection;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TeamcityReport
 *
 * Creates teamcity report which set env variables to teamcity
 *
 * @package Bukharovsi\DockerPlugin\Docker\Report\Teamcity
 */
class TeamcityBuiltImageVersionReport implements IReport
{
    /**
     * @var string[]
     */
    private $teamcityVariables;

    /**
     * @var BuiltImage;
     */
    private $builtImage;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * TeamcityReport constructor.
     * @param BuiltImage $builtImage
     * @param Output $output
     * @param TeamcityVariableCollection $tcVariables
     */
    public function __construct(BuiltImage $builtImage, Output $output, TeamcityVariableCollection $tcVariables)
    {
        $this->builtImage = $builtImage;
        $this->output = $output;
        $this->teamcityVariables = $tcVariables;
    }

    public function make()
    {
        $this->teamcityVariables->rewind();
        foreach ($this->builtImage->versions() as $version) {
            $this->output->writeln(
                "##teamcity[setParameter name='".$this->teamcityVariables->next()."' value='" .$version. "']"
            );
        }

    }


}
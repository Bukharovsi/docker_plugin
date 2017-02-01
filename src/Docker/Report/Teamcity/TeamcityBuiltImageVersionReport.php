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
     * TeamcityReport constructor.
     *
     * @param TeamcityVariableCollection $tcVariables
     */
    public function __construct(TeamcityVariableCollection $tcVariables)
    {
        $this->teamcityVariables = $tcVariables;
    }

    /**
     * Make a report
     *
     * @param BuiltImage $builtImage
     * @param OutputInterface $output
     */
    public function make(BuiltImage $builtImage, OutputInterface $output)
    {
        $this->teamcityVariables->rewind();
        foreach ($builtImage->versions() as $version) {
            $output->writeln(
                "##teamcity[setParameter name='".$this->teamcityVariables->next()."' value='" .$version. "']"
            );
        }

    }


}
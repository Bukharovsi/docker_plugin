<?php

namespace Bukharovsi\DockerPlugin\Docker\Report\Teamcity;

use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;

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
     * @return string
     */
    public function make(BuiltImage $builtImage)
    {
        $report = '';
        $this->teamcityVariables->rewind();
        foreach ($builtImage->versions() as $version) {
            $report.="##teamcity[setParameter name='".$this->teamcityVariables->next()."' value='" .$version. "']";
        }

        return $report;
    }
}

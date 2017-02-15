<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 15.02.17
 * Time: 15:24
 */

namespace Bukharovsi\DockerPlugin\VCS\Strategy;


class VersionGenerationFixVersionStrategy implements IVersionGenerationStrategy
{
    private $versions;

    /**
     * VersionGenerationFixVersionStrategy constructor.
     * @param $versions
     */
    public function __construct($versions)
    {
        $this->versions = $versions;
    }


    public function versions()
    {
        return $this->versions;
    }


}
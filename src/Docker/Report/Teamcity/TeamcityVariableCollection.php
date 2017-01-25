<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 25.01.17
 * Time: 15:12
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Teamcity;


class TeamcityVariableCollection
{
    /**
     * @var string[]
     */
    private $teamcityVariables;

    private $iterator;

    /**
     * TeamcityVariableColleciton constructor.
     */
    public function __construct()
    {
        $this->teamcityVariables = new \ArrayObject(
            [
                'env.BuildTag',
                'env.BuildTag.1',
                'env.BuildTag.2',
                'env.BuildTag.3',
            ]
        );
        $this->iterator = new \ArrayIterator($this->teamcityVariables);
    }

    public function current()
    {
        return $this->iterator->current();
    }

    public function next()
    {
        $current = $this->current();
        $this->iterator->next();

        return $current;
    }

    public function rewind()
    {
        $this->iterator->rewind();
    }




}
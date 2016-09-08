<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 08.09.16
 * Time: 15:15
 */

namespace Bukharovsi\DockerPlugin\Docker\Tag;


/**
 * Class Tag
 *
 * Represent a docker image tag
 *
 * @package Bukharovsi\DockerPlugin\Docker\Tag
 */
class Tag
{
    private $name;

    private $version;

    public function __construct($name, $version = null)
    {
        $this->name = $name;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * string represent of tag
     *
     * @return string
     */
    function __toString()
    {
        $stringTag = $this->name;

        if (!empty($this->version)) {
            $stringTag .= ':'.$this->version;
        }

        return $stringTag;

    }


}
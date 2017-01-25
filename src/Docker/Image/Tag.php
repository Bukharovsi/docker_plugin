<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 18.01.17
 * Time: 23:46
 */

namespace Bukharovsi\DockerPlugin\Docker\Image;


class Tag
{
    private $name;

    private $version;

    /**
     * Tag constructor.
     * @param $name
     * @param $version
     */
    public function __construct($name, $version = 'latest')
    {
        $this->name = $name;
        $this->version = $version;
    }

    public function version()
    {
        return $this->version;
    }


    public function __toString() {
        return $this->name.':'.$this->version;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.02.17
 * Time: 15:13
 */

namespace Bukharovsi\DockerPlugin\VCS\Strategy;


interface IVersionGenerationStrategy
{
    public function versions();
}
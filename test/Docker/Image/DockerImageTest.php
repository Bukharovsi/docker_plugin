<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 22.01.17
 * Time: 18:16
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\Image;


use Bukharovsi\DockerPlugin\Docker\Configuration\ManualConfiguration;
use Bukharovsi\DockerPlugin\Docker\ExecutionCommand\ConsoleCommandBuilder;
use Bukharovsi\DockerPlugin\Docker\Image\DockerImage;

class DockerImageTest extends \PHPUnit_Framework_TestCase
{
    public function imageTest()
    {
        $configuration = new ManualConfiguration('nginx');
        $image = new DockerImage($configuration, new ConsoleCommandBuilder());

        $image->build();
    }

}

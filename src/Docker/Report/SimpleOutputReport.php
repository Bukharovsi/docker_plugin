<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 24.01.17
 * Time: 22:05
 */

namespace Bukharovsi\DockerPlugin\Docker\Report;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

class SimpleOutputReport implements IReport
{
    /**
     * @var BuiltImage;
     */
    private $builtImage;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * SimpleOutputReport constructor.
     * @param BuiltImage $builtImage
     * @param OutputInterface $output
     */
    public function __construct(BuiltImage $builtImage, Output $output)
    {
        $this->builtImage = $builtImage;
        $this->output = $output;
    }

    public function make()
    {
        foreach ($this->builtImage->tags() as $tag) {
            $this->output->writeln("Image with tag $tag has been created");
        }
    }


}
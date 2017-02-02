<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 11:54
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Html;


use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;

class PrintableImage
{

    /**
     * @var PrintableTag
     */
    private $tags;
    /**
     * PrintableImage constructor.
     * @param $image
     */
    public function __construct(BuiltImage $image)
    {
        foreach ($image->tags() as $tag) {
            $this->tags[] = new PrintableTag($tag);
        }
    }

    public function __toString()
    {
        $report = '<div class="docker-image">';
        foreach ($this->tags as $tag) {
            $report .= $tag->__toString();
        }
        $report .= '</div>';
        return $report;
    }


}
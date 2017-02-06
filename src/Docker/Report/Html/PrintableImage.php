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
     * @var PrintableTag[]
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
        $report = '<div class="docker-image">'.PHP_EOL;
        foreach ($this->tags as $tag) {
            $report .= $tag;
        }
        $report .= '</div>'.PHP_EOL;;
        return $report;
    }


}
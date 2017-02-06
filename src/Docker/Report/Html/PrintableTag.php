<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 02.02.17
 * Time: 11:44
 */

namespace Bukharovsi\DockerPlugin\Docker\Report\Html;


use Bukharovsi\DockerPlugin\Docker\Image\Tag;

class PrintableTag
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * ImageTagForHtml constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function __toString()
    {
        return
            <<<HTML
<div class="imageTag">
    $this->tag
</div>
HTML;
    }


}
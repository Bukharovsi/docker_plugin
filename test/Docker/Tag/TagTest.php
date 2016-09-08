<?php

use Bukharovsi\DockerPlugin\Docker\Tag\Tag;


class TagTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSimplestTag()
    {
        $tag = new Tag('my_project');
        static::assertEquals('my_project', (string) $tag);
    }

    public function testCreateTagWithVersion()
    {
        $tag = new Tag('my_project', '2.0');
        static::assertEquals('my_project:2.0', (string) $tag);
    }
}

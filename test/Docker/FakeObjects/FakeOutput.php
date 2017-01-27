<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 27.01.17
 * Time: 13:38
 */

namespace Bukharovsi\DockerPlugin\Test\Docker\FakeObjects;


use Symfony\Component\Console\Output\Output;

class FakeOutput extends Output
{
    public $output = '';

    public function clear()
    {
        $this->output = '';
    }

    protected function doWrite($message, $newline)
    {
        $this->output .= $message.($newline ? "\n" : '');
    }
}
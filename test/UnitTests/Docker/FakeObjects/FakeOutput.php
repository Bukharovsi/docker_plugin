<?php

namespace Bukharovsi\DockerPlugin\Test\UnitTests\Docker\FakeObjects;

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

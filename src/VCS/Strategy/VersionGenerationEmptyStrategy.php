<?php

namespace Bukharovsi\DockerPlugin\VCS\Strategy;

class VersionGenerationEmptyStrategy implements IVersionGenerationStrategy
{
    public function versions()
    {
        return [];
    }

}
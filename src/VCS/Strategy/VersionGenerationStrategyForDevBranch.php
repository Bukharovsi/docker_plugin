<?php

namespace Bukharovsi\DockerPlugin\VCS\Strategy;


class VersionGenerationStrategyForDevBranch implements IVersionGenerationStrategy
{

    public function versions()
    {
        return ['dev'];
    }

}
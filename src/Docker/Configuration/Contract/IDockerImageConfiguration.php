<?php

namespace Bukharovsi\DockerPlugin\Docker\Configuration\Contract;

/**
 * Interface IDockerImageConfiguration
 *
 * Contract for docker image build command
 * It defines Image Name, Image tags, Path to dockerfile and working directory
 *
 * @package Bukharovsi\DockerPlugin\Docker\Configuration\Contract
 */
interface IDockerImageConfiguration
{

    /**
     * Defines image name.
     *
     * This is first (nginx) part of full docker tag like nginx:latest
     * @return string
     */
    public function imageName();

    /**
     * Defines second (latest) part of full docker tag like nginx:latest
     *
     * @return string[]
     */
    public function imageTags();

    /**
     * Defines path to Dockerfile. It includes Dockerfile name
     *
     * @return string
     */
    public function dockerFilePath();

    /**
     * Defines working directory. This is last argument for docker build command
     *
     * in common cases this it root path of project
     *
     * @return string
     */
    public function workingDirectory();
}

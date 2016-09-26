<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 15:45
 */

namespace Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy;

use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Interfaces\DockerConfigParamInterface;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class ImageTag
 *
 * @package Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy
 */
class ImageTag implements DockerConfigParamInterface
{
    public function build(array $dockerConfig, RootPackageInterface $packageInfo, InputInterface $input)
    {
        if (isset($input->getOptions()['tag'])
            && $input->getOptions()['tag'] != null) {
            return $input->getOptions()['tag'];
        }

        return array_key_exists('version', $dockerConfig) ?
            $this->getTagForImage($dockerConfig['version'], $packageInfo) :
            'latest';
    }

    /**
     * @param                      $configVersion
     * @param RootPackageInterface $packageInfo
     *
     * @return mixed|string
     */
    private function getTagForImage($configVersion, RootPackageInterface $packageInfo)
    {
        if (is_string($configVersion) && $configVersion != '@vcs') {
            return $configVersion;
        }

        if ($configVersion == '@vcs') {
            return str_replace('dev-', '', $packageInfo->getFullPrettyVersion());
        }

        return 'latest';
    }
}

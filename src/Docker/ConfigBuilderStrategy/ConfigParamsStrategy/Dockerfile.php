<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 17:47
 */

namespace Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy;

use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Interfaces\DockerConfigParamInterface;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Dockerfile
 *
 * todo что дает это название? класс Докерфай? что он представляет? содержит докерфайл?
 * todo примеры:
 * DockerfileChoosingStrategyUseDefault
 * DockerfileChoosingStrategyPreferFromComposerJSONConfig
 * DockerfileChoosingStrategyPreferFromUserInput
 * DockerfileChoosingStrategyUseFromComposerJSONConfigAndUserInput
 *
 * todo и какраз в этих стратегиях должно быть четко прописано, что по умолчания, если ничего не указано мы ищем dockerfile в корне
 * к примеру если используем DockerfileChoosingStrategyUseDefault - то не смотрим ни на какие параметры, тупо докерфайл юзаем
 * DockerfileChoosingStrategyPreferFromComposerJSONConfig - тут берем по умолчанию, и если задан в конфиге - перетираем значение по умолчанию
 *
 * @package Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy
 */
class Dockerfile implements DockerConfigParamInterface
{
    /**
     * @param array                $dockerConfig
     * @param RootPackageInterface $packageInfo
     * @param InputInterface       $input
     *
     * todo что возвращает эта функция? что это за стринг?
     *
     * @return string
     */
    public function build(array $dockerConfig, RootPackageInterface $packageInfo, InputInterface $input)
    {
        return isset($dockerConfig['dockerfile']) && is_string($dockerConfig['dockerfile']) ?
            $dockerConfig['dockerfile'] :
            null;
    }
}

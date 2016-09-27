<?php
/**
 * Created by PhpStorm.
 * User: Rinat Gizatullin
 * Date: 26.09.16
 * Time: 12:03
 */

namespace Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy;

use Bukharovsi\DockerPlugin\Command\Exceptions\DockerExecutionException;
use Bukharovsi\DockerPlugin\Docker\Config\DockerConfigParameters;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Dockerfile;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\ImageName;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\ImageTag;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\Interfaces\DockerConfigParamInterface;
use Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy\ConfigParamsStrategy\WorkingDirectory;
use Composer\Package\RootPackageInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class DockerConfigBuilderStrategy
 *
 * todo НИ одного теста! по крайней мере стратегии нужно бы покрыть тестами и билдер статегий.
 *
 * @package Bukharovsi\DockerPlugin\Docker\ConfigBuilderStrategy
 */
class DockerConfigBuilderStrategy
{
    /**
     * @var array of params from composer.json
     */
    private $dockerConfig;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var RootPackageInterface
     */
    private $packageInfo;

    /**
     * @var ImageName
     */
    private $imageNameStrategy;

    /**
     * @var ImageTag
     */
    private $imageTagStrategy;

    /**
     * @var Dockerfile
     */
    private $dockerfileStrategy;

    /**
     * @var WorkingDirectory
     */
    private $workingDirectoryStrategy;

    /**
     * DockerConfigBuilderStrategy constructor.
     *
     * @param InputInterface       $input
     * @param RootPackageInterface $packageInfo
     */
    public function __construct(InputInterface $input, RootPackageInterface $packageInfo)
    {
        $this->input = $input;
        $this->packageInfo = $packageInfo;
        $this->dockerConfig = $this->getDockerConfigFromComposer();

        $this->imageNameStrategy = new ImageName();
        $this->imageTagStrategy = new ImageTag();
        $this->dockerfileStrategy = new Dockerfile();
        $this->workingDirectoryStrategy = new WorkingDirectory();
    }

    /**
     * @param DockerConfigParamInterface $imageNameStrategy
     */
    public function setImageNameStrategy(DockerConfigParamInterface $imageNameStrategy)
    {
        $this->imageNameStrategy = $imageNameStrategy;
    }

    /**
     * @param DockerConfigParamInterface $imageTagStrategy
     */
    public function setImageTagStrategy(DockerConfigParamInterface $imageTagStrategy)
    {
        $this->imageTagStrategy = $imageTagStrategy;
    }

    /**
     * Build config params
     *
     * todo  с трудом понял, что тут такое происходит. Ессли уж такой жесткий свитч-кейс, проще создать несколько методов:
     * todo chooseDockerfileCommand
     * todo chooseImageTags
     *
     * @param $param
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function build($param)
    {
        $paramBuilder = null;
        switch ($param) {
            case DockerConfigParameters::IMAGE_NAME:
                $paramBuilder = $this->imageNameStrategy;
                break;
            case DockerConfigParameters::IMAGE_TAG:
                $paramBuilder = $this->imageTagStrategy;
                break;
            case DockerConfigParameters::DOCKERFILE:
                $paramBuilder = $this->dockerfileStrategy;
                break;
            case DockerConfigParameters::WORKING_DIRECTORY:
                $paramBuilder = $this->workingDirectoryStrategy;
                break;
            default:
                throw new \Exception('Not found docker config param = ' . $param);
                break;
        }

        return $paramBuilder->build($this->dockerConfig, $this->packageInfo, $this->input);
    }

    /**
     * Return docker config from composer json
     *
     * todo название фукции абстрактное, по аргументам не понятно что она делает, что возвращает
     *
     * @return array
     */
    private function getDockerConfigFromComposer()
    {
        // todo а что делать, если buildName не указали?
        $buildName = $this->input->getArguments()['buildName'];

        // todo ты ведь знаешь как бесит когда ты поставил какое-то ПО, запускаешь его, а оно тебе "нихера работать не буду". укажите в конфиге параметр такой то
        // todo ты указал, запускаешь, а он тебе про другой параметр опять.
        // todo давай сделаем что эта хрень может работать если ни в коандной строке, ни в конфиге ничего не указано. Ведь можно использовать параметры по умолчанию
        // todo название взять из имени проекта, докерфайл поискать в корне проекта и пр. Давай хоть раз напишем то, чем приятно пользоваться
        $extra = $this->packageInfo->getExtra();
        if (!array_key_exists('docker', $extra)) {
            throw DockerExecutionException::installPluginError();
        }

        $dockerBuilds = $extra['docker'];
        if (!array_key_exists($buildName, $dockerBuilds)) {
            throw DockerExecutionException::buildSectionNameError();
        }

        return $dockerBuilds[$buildName];
    }
}

<?php

namespace Bukharovsi\DockerPlugin\Docker\Report\Html;

use Bukharovsi\DockerPlugin\Docker\Image\BuiltImage;
use Bukharovsi\DockerPlugin\Docker\Report\Contract\IReport;
use League\Plates\Engine;
use Symfony\Component\Console\Output\OutputInterface;

class HTMLReport implements IReport
{

    /**
     * @var Engine
     */
    private $templateEngine;

    const REPORT_TEMPLATE_PATH = __DIR__ . DIRECTORY_SEPARATOR .'Template';

    /**
     * HTMLReport constructor.
     * @param Engine $templateEngine
     */
    public function __construct(Engine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }


    /**
     * @param BuiltImage $builtImage
     * @param OutputInterface $output
     * @return string
     */
    public function make(BuiltImage $builtImage)
    {
        $printableImage = new PrintableImage($builtImage);

        $template = $this->templateEngine->make('builtImages');
        $template->data( ['printableImage' => $printableImage]);

        return $template->render();
    }



}
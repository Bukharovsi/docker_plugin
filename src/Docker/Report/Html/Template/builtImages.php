<?php
/** @var \League\Plates\Template\Template $this */
/** @var \Bukharovsi\DockerPlugin\Docker\Report\Html\PrintableImage $printableImage */

    $this->layout('main');
?>
<div class="docker-html-report">
 <?=$printableImage?>
</div>


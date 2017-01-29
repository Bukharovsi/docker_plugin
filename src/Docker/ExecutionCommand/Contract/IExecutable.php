<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 20.01.17
 * Time: 17:46
 */

namespace Bukharovsi\DockerPlugin\Docker\ExecutionCommand\Contract;


/**
 * Interface IExecutable
 *
 * Common interface for all dexecutable commands
 */
interface IExecutable
{

    public function execute();
}
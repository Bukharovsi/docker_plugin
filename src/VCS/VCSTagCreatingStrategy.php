<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 19.01.17
 * Time: 23:58
 */

namespace Bukharovsi\DockerPlugin\VCS;


class VCSTagCreatingStrategy
{
    private function calculateTagByBranch($branch) {

        $tags = [];
        switch (true) {
            case $branch == 'master' :
                $tags[] = 'latest';
                break;
            case $branch == '4.5.6': //git tag
                $tags = ["latest", $branch];
                break;
            case $branch == 'dev':
                $tags = ['dev'];
                break;
            default:
                $tags = [$branch];
        }

        return $tags;


    }
}
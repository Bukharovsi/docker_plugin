PHP Docker plugin
=================
[![Build Status](https://travis-ci.org/Bukharovsi/docker_plugin.svg?branch=master)](https://travis-ci.org/Bukharovsi/docker_plugin)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/9dc4bc91426744b3b812cba54dc825d7)](https://www.codacy.com/app/bukharovSI/docker_plugin?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Bukharovsi/docker_plugin&amp;utm_campaign=Badge_Grade)
[![Dependency Status](https://www.versioneye.com/user/projects/58a763664ca76f0047de1714/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58a763664ca76f0047de1714)

PHP Docker plugin is a plugin for composer that helps build and push docker images. 
It is very useful for continuous integration.
This plugin allow you to define image name, compute tags and generate reports.

When you use this plugin you still need `Dockerfile`. The plugin only simplified automation build!

Basic usage
-----------
If you already have `Dockerfile` and can build image manually just install plugin and build image immediately 
and push it to docker registry
```
php composer.phar require bukharovsi/docker_plugin
php composer.phar docker:build
php composer.phar docker:push
```
You will get docker image with tag: <your_project_name>:<your_project_version>

Advanced usage
--------------
###How to change project defaults? 
Defaults can be changed in `composer.json` and with console arguments

####Change project defaults in `composer.json`
define in `composer.json` `extra` section:
```
"extra": {
    "docker": {
          "name": "wine_the_pooh.com/honey",
          "version": "1.0",
          "dockerfile": "Dockerfile",
          "workingdirectory": "."
    }
}
```
all definitions are optional

####Change project defaults with console arguments
all arguments are optional
```
php composer.phar docker:build --name wine_the_pooh.com --tag latest --dockerfile Dockerfile --workingdirectory /var/www/wine_the_pooh
```

####Getting image version from git
If you are using Git for version control or git flow you can generate image tag based on current Git branch or Git tag.
For using this feature specify `"version":"@vcs"` in `composer.json` or add `--tag @vcs` to `composer docker:build` 
and `composer docker:push` command 
How does Git tag transforms to Docker tag?

| Git branch                | Docker tag                                                                                    |
|---------------------------|-----------------------------------------------------------------------------------------------|
| master                    | latest, (*if commit has a git tag then it add docker tag that will be equals current git tag) |
| dev, develop, development | dev                                                                                           |
| any_other_branch          | any_other_branch, Commit SHA                                                                |

### Integration with Teamcity
Docker plugin can notify Teamcity about built image versions. This plugin use teamcity environment variables 
 - `env.BuildTag`
 - `env.BuildTag.1`
 - `env.BuildTag.2`
 - ...
 - `env.BuildTag.n`
 
 after running `composer docker:build` you can use `%env.BuildTag%` and other variables in your scripts

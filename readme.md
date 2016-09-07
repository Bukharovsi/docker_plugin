### how to use
 build docker image with default name and latest tag
 
    composer docker build

 build docker image with tag mypackage:latest

    composer docker build -t mypackage:2.0
 
 build docker image with default tag name and specified version

    composer docker build -t :2.0
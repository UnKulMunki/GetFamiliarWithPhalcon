<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        // GxC: added because composer like 2 put files in "vendor" on the BASE_PATH by default. 
        $config->application->vendorDir
    ]
)->register();

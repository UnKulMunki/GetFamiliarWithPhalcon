<?php

/**
 * Load shared configuration service
 */
$di->setShared(
    'config', function () {
        return include APP_PATH . "/config/config.php";
    }
);

$router = $di->getRouter();
$config = $di->getConfig();

// Define your routes here
$router->setDefaultController($config->application->defaultController);

$router->handle();

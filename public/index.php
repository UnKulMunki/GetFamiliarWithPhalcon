<?php
/** 
 * Initialize the PhalconPHP env
 *
 * @category  Bootstrap
 * @package   Getting_Familiar_With_Phalcon
 * @author    Gary Cartagena <GaryC@CompGu.com>
 * @copyright 2017 Copyright Gary Cartagena / CoGu LLC. / CompGu.com 
 * @license   Open Source - Lesser GPL 
 * @version   GIT: <git_id>
 * @link      https://docs.phalconphp.com/en/3.0.0/reference/tutorial.html
 * @since     2017, May 18 2100
**/

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * The AutoLoader automatically loads class files that map the 
     * the namespace located within  directories specified below.
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Create a request handler
     */
     $application = new Application($di);

    /**
     * Create a response object, that can display the view+response
     */
    $response = $application->handle();
    $response->send();

    // We could also have used an echo to display the view content, like below:
    // echo $application->handle()->getContent();

} catch ( \Exception $e ) {
    echo "Exception: ", $e->getMessage();
}
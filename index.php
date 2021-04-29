<?php
/**
 * Entry point of the application
 * All the requests are handled by this file
 * php version 7.3.5
 *
 * @category Index
 * @package  Index
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
define("VALID_REQ", true);

require_once 'system/core/FrameworkException.php';

require_once 'system/core/Loader.php';

require_once 'system/core/EnvParser.php';

/**
 * Location of config directory
 */
$configDir = 'app/config';
/**
 * Lods env files
 */
try {
    (new EnvParser('.env'))->load();
    /**
     * Loads all configs
     */
    if (file_exists('app/config')) {
        foreach (glob("$configDir/*.php") as $filename) {
            include $filename;
        }
    } else {
        throw new FrameworkException("Unable to load config files");
    }
} catch (FrameWorkException $e) {
    error_log($message . "\n", 3, "system/exceptions.log");
    header('HTTP/1.1 500 Internal Server Error');
    die("Server Error");
}

try {
    Loader::intialize(); // Initialize the Loader
} catch (FrameworkException $e) {
    Log::getInstance()->fatal(
        $exception->getMessage() . " in " . $exception->getFile() ." at line "
            . $exception->getLine()
    );
}

Session::getInstance(); // Initialize the Session
Log::getInstance();
session_start();

global $config;

/**
 * Sets timezone
 */
isset($config['timezone']) and date_default_timezone_set($config['timezone']);

/**
 * Defines ENVIRONMENT
 */
define('ENVIRONMENT', $config['environment'] ?? Constants::ENV_DEVELOPMENT);

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
    case Constants::ENV_DEVELOPMENT:
        error_reporting(E_ALL);
        break;
    case Constants::ENV_TESTING:
    case Constants::ENV_PRODUCTION:
        error_reporting(0);
        break;
    default:
        Log::getInstance()->fatal("Invalid enviroment found");
        header('HTTP/1.1 500 Internal Server Error');
        die("Server Error");
    }
}

if (!function_exists("errHandler")) {
    /**
     * Error handler
     *
     * @param $errNo   Error level
     * @param $errMsg  Error Message
     * @param $errFile Error File
     * @param $errLine Error Line
     *
     * @return void
     */
    function errHandler($errNo, $errMsg, $errFile, $errLine)
    {
        ob_get_contents() and ob_end_clean();
        Log::getInstance()->error(
            $errMsg . ' in ' . $errFile . ' at line ' . $errLine
        );
        Router::error();
    }
}

if (!function_exists("exceptionHandler")) {
    /**
     * Error handler
     *
     * @param $exception Exception object
     *
     * @return void
     */
    function exceptionHandler($exception)
    {
        ob_get_contents() and ob_end_clean();
        Log::getInstance()->error(
            $exception->getMessage() . " in " . $exception->getFile() ." at line "
                . $exception->getLine()
        );
        Router::error();
    }
}

set_exception_handler('exceptionHandler');
set_error_handler("errHandler");

ob_start();
Router::run();
$output = ob_get_contents();
ob_end_clean();
echo $output;

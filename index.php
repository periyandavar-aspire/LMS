<?php
/**
 * Constants File Doc Comment
 * All the requests are handled by this file
 * php version 7.3.5
 *
 * @category IndexFile
 * @package  IndexFile
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

define("VALID_REQ", true);

session_start();

require_once 'system/core/Loader.php';

foreach (glob("app/config/*.php") as $filename) {
    include $filename;
}

Loader::intialize();


global $config;

define('ENVIRONMENT', $config['environment'] ?? Constants::ENV_DEVELOPMENT);

set_exception_handler('exceptionHandler');
set_error_handler("errHandler");

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
        exit('The application environment is not set correctly.');
    }
}

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
    global $config;
    ob_end_clean();
    $message = "Error caught! [$errNo] $errMsg at "
        . "File [$errFile] line number [$errLine] on "
        . date("m/d/Y h:i:s A", time());
    if (ENVIRONMENT == Constants::ENV_PRODUCTION) {
        Route::error();
        // error_log(
        //     $message . "\n",
        //     1,
        //     $config['mailTo'],
        //     $config['serverEmail']
        // );
    } else {
        error_log($message . "\n", 3, $config['logs'] . "/errors.log");
        Route::error($message);
    }
}

/**
 * Error handler
 *
 * @param $exception Exception object
 *
 * @return void
 */
function exceptionHandler($exception)
{
    global $config;
    ob_end_clean();
    $message = "Uncaught exception: " . $exception->getMessage() . " at "
        . "File [" . $exception->getFile() . "] line number ["
        . $exception->getLine() . "] on "
        . date("m/d/Y h:i:s A", time());
    if (ENVIRONMENT == Constants::ENV_PRODUCTION) {
        Route::error();
        // error_log(
        //     $message . "\n",
        //     1,
        //     $config['mailTo'],
        //     $config['serverEmail']
        // );
    } else {
        error_log($message . "\n", 3, $config['logs'] . "/exceptions.log");
        Route::error($message);
    }
}

ob_start();
Route::run();
$output = ob_get_contents();
ob_end_clean();
echo $output;

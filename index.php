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


require_once 'system/core/Loader.php';

require_once 'system/core/EnvParser.php';

require_once 'system/Database/database.php';



(new EnvParser('.env'))->load();

foreach (glob("app/config/*.php") as $filename) {
    include $filename;
}

Loader::intialize();
Session::getInstance();
session_start();
global $config;

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
        exit('The application environment is not set correctly.');
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
        $errNo == E_USER_WARNING || $errNo == E_USER_NOTICE
            ? Log::getInstance()->warning(
                $errMsg,
                [
                    'File' => $errFile,
                    'Line' => $errLine
                ]
            )
            : Log::getInstance()->warning(
                $errMsg,
                [
                    'File' => $errFile,
                    'Line' => $errLine
                ]
            );
        Route::error();
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
            $exception->getMessage(),
            [
            'File' => $exception->getFile(),
            'Line' => $exception->getLine()
            ]
        );
        Route::error();
    }
}

ob_start();
Route::run();
$output = ob_get_contents();
ob_end_clean();
echo $output;

<?php
/**
 * IssuedBookController File Doc Comment
 * php version 7.3.5
 *
 * @category   Core
 * @package    Core
 * @subpackage Autoload
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

/**
 * This autoload function loads controllers, models, services, dbhandlers
 * and views on need
 */
spl_autoload_register(
    function ($className) {
        global $config;
        if (Utility::endsWith(strtolower($className), 'controller')) {
            $ctrlPath = $config['controller'];
            $file = $ctrlPath . $className . ".php";
            if (file_exists($file)) {
                include_once $file;
            }
        } elseif (Utility::endsWith(strtolower($className), 'model')) {
            $ModelPath = $config['model'];
            $file = $ModelPath . $className . ".php";
            if (file_exists($file)) {
                include_once $file;
            }
        } elseif (Utility::endsWith(strtolower($className), 'service')) {
            $ModelPath = $config['service'];
            $file = $ModelPath . $className . ".php";
            if (file_exists($file)) {
                include_once $file;
            }
        } elseif (Utility::endsWith(strtolower($className), 'handler')) {
            $DBPath = $config['db_handler'];
            $file = $DBPath . $className . ".php";
            if (file_exists($file)) {
                include_once $file;
            }
        } elseif (Utility::endsWith(strtolower($className), 'view')) {
            $ViewPath = $config['view'];
            $file = $ViewPath . $className . ".php";
            if (file_exists($file)) {
                include_once $file;
            }
        }
    }
);

/**
 * This autoload function loads all the core base classes from core directory on need
 */
spl_autoload_register(
    function ($className) {
        $file = 'core/base/' . $className . ".php";
        if (file_exists($file)) {
            include_once $file;
        }
    }
);

/**
 * This autoload function loads all the core classes from core directory on need
 */
spl_autoload_register(
    function ($className) {
        $file = 'core/' . $className . ".php";
        if (file_exists($file)) {
            include_once $file;
        }
    }
);

/**
 * This function will load all files from config directory
 */
// function loadConfig()
// {
//     foreach (glob("config/*.php") as $filename) {
//         require_once $filename;
//     }
//     if (isset($config['conf-dir'])) {
//         if ($config['conf-dir'] != '') {
//             $dirs = array_slice($config['conf-dir'], ",");
//             foreach ($dirs as $dir) {
//                 foreach (glob($dir) as $filename) {
//                     require_once $filename;
//                 }
//             }
//         }
//     }
// }

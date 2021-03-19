<?php
/**
 * includes all config files
 */
require_once 'config/config.php';
require_once 'config/routeConfig.php';
require_once 'config/dbConfig.php';

/**
 * This autoload function loads all the classes from core directory on need
 */
spl_autoload_register(function ($className) {
    $file = 'core/' . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

/**
 * This autoload function loads all the classes from core/base directory on need
 */
spl_autoload_register(function ($className) {
    $file = 'core/base/' . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

/**
 * This autoload function loads all the classes from helpers directory on need
 */
spl_autoload_register(function ($className) {
    $file = 'core/helpers/' . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

/**
 * This autoload function loads all the controllers from controllers directory on need
 */
spl_autoload_register(function ($className) {
    global $config;
    $ctrlPath = $config['controllers'];
    $file = $ctrlPath . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

/**
 * This will loads the models form models directory on need
 */
spl_autoload_register(function ($className) {
    global $config;
    $ModelPath = $config['models'];
    $file = $ModelPath . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

/**
 * This will loads the dbhandlers form dbhandlers directory on need
 */
spl_autoload_register(function ($className) {
    global $config;
    $DBPath = $config['db_handlers'];
    $file = $DBPath . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});

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

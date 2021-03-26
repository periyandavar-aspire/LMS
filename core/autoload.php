<?php

/**
 * This autoload function loads all the controller, model, service, handlers, view classes from core directory on need
 */
spl_autoload_register(function ($className) {
    global $config;
    if (Utility::endsWith(strtolower($className), 'controller')) {
        $ctrlPath = $config['controller'];
        $file = $ctrlPath . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    } elseif (Utility::endsWith(strtolower($className), 'model')) {
        $ModelPath = $config['model'];
        $file = $ModelPath . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    } elseif (Utility::endsWith(strtolower($className), 'service')) {
        $ModelPath = $config['service'];
        $file = $ModelPath . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    } elseif (Utility::endsWith(strtolower($className), 'handler')) {
        $DBPath = $config['db_handler'];
        $file = $DBPath . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    } elseif (Utility::endsWith(strtolower($className), 'view')) {
        $ViewPath = $config['view'];
        $file = $ViewPath . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

/**
 * This autoload function loads all the core classes from core directory on need
 */
spl_autoload_register(function ($className) {
    $file = 'core/' . $className . ".php";
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
// spl_autoload_register(function ($className) {
//     global $config;
//     $ctrlPath = $config['controllers'];
//     $file = $ctrlPath . $className . ".php";
//     if (file_exists($file)) {
//         require_once $file;
//     }
// });

/**
 * This will loads the models form models directory on need
 */
// spl_autoload_register(function ($className) {
//     global $config;
//     $ModelPath = $config['models'];
//     $file = $ModelPath . $className . ".php";
//     if (file_exists($file)) {
//         require_once $file;
//     }
// });

/**
 * This will loads the models form models directory on need
 */
// spl_autoload_register(function ($className) {
//     global $config;
//     $ModelPath = $config['services'];
//     $file = $ModelPath . $className . ".php";
//     if (file_exists($file)) {
//         require_once $file;
//     }
// });

/**
 * This will loads the dbhandlers form dbhandlers directory on need
 */
// spl_autoload_register(function ($className) {
//     global $config;
//     $DBPath = $config['db_handlers'];
//     $file = $DBPath . $className . ".php";
//     if (file_exists($file)) {
//         require_once $file;
//     }
// });

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

<?php
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
 * This autoload function loads all the controllers from controllers directory on need
 */
spl_autoload_register(function ($className) {
    $file = 'Controllers/' . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});
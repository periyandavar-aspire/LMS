<?php
//defined('VALID_REQ') OR exit('Not a valid Request');

function baseURL()
{
    global $config;
    return $config['base_url'];
}

spl_autoload_register(function ($className) {
    $file = 'core/' . $className . ".php";
    if (file_exists($file)) {
        require_once $file;
    }
});
<?php
define("VALID_REQ",true);
session_start();
require_once 'config/config.php';
require_once 'core/core.php';
require_once 'core/Controller.php';

$path = $_SERVER['PATH_INFO'] ?? $config['default_page'];
$req = explode('/', ltrim($path));
$ctrl = $req[1];
$method = $req[2] ?? 'index';

if ($method === "") {
    header('Location: ' . "../" . $ctrl . "/index");
    exit();
}

if ($method===null) {
    header('Location: ' . $ctrl . "/index");
    exit();
}

$ctrlPath = $config['controllers'] . $ctrl . 'Controller.php';

if (file_exists($ctrlPath)) {
    require_once $config['controllers'] . $ctrl . 'Controller.php';
    $controllerName = ucfirst($ctrl) . "Controller";
    $controllerObj = new $controllerName();
    if (method_exists($controllerName, $method)) {
        $controllerObj->$method();
    } else {
        header('HTTP/1.1 404 Not Found');
        die('404 - The method - ' . $method . ' - not found');
    }
} else {
    header('HTTP/1.1 404 Not Found');
    die('404 - The file - ' . $ctrlPath . ' - not found');
}
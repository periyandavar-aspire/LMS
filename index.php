<?php
require_once 'config/config.php';
require_once 'core/Controller.php';
$path = $_SERVER['PATH_INFO'] ?? DEFAULT_PAGE;
$req = explode('/', ltrim($path));
$ctrl = $req[1];
// $method = $req[2] ?? 'index';
// $method = ($method!="")?$method:'index';
$method = $req[2];
if($method==null || $method==""){
    header('Location: ' . $ctrl."/index");
    exit();
}
$ctrlPath= CTRL_DIR.$ctrl.'Controller.php';
if(file_exists($ctrlPath)){
    require_once CTRL_DIR.$ctrl.'Controller.php';
    $controllerName= ucfirst($ctrl)."Controller";
    $controllerObj= new $controllerName();
    if(method_exists($controllerName,$method))
        $controllerObj->$method();
    else{
        header('HTTP/1.1 404 Not Found');
        die('404 - The method - '.$method.' - not found');
    }
}else{
    header('HTTP/1.1 404 Not Found');
    die('404 - The file - '.$ctrlPath.' - not found');
}
// $controller= new $ctrl;
// $controller->$method();

// function __autoload( $class_name )
// {
//     require_once('controllers/' . $class_name . '/' . $class_name . '.php' );
// }
<?php


$route["user/*"] = function (): bool {
    $method = func_get_arg(0);
    if ($method == "index") {
        return true;
    } else {
        $cname = staticCtrlFromSession('user');
        if ($cname == null) {
            (new HomeController())->index();
        } else {
            $cname::executeMethod($method);
        }
    }
    return false;
};

// $routes = array_keys($route);
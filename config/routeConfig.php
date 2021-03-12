<?php


$route["user/*"] = function (): ?bool {
    $method = func_get_arg(0);
    if ($method == "index") {
        return true;
    } else {
        $obj = CtrlFromSession('user');
        if ($obj == null) {
            (new UserController())->index();
        } else {
            $obj->executeMethod($method);
        }
        return null;
    }
    return false;
};

// $routes = array_keys($route);
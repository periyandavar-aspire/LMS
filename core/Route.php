<?php

class Route
{
    private static $getMethodRoutes = [];
    private static $postMethodRoutes = [];
    private static $otherRoutes = [];

    private static $methodNotAllowed = null;
    private static $pathNotFound = null;
    private static $onError = null;

    public static function add(string $expression, ?string $route = null, string $method = 'get', ?callable $filter = null)
    {
        $method = strtolower($method);
        if ($method == 'get') {
            array_push(
                self::$getMethodRoutes,
                [ 'expression' => $expression, 'route' => $route,'rule' => $filter]
            );
        } elseif ($method == 'post') {
            array_push(
                self::$postMethodRoutes,
                [ 'expression' => $expression, 'route' => $route,'rule' => $filter]
            );
        } else {
            array_push(
                self::$otherRoutes,
                [ 'expression' => $expression, 'route' => $route,'rule' => $filter]
            );
        }
    }

    public static function setMethodNotAllowed(callable $callback)
    {
        self::$methodNotAllowed = $callback;
    }

    public static function setPathNotFound(callable $callback)
    {
        self::$pathNotFound = $callback;
    }

    public static function setOnError(callable $callback)
    {
        self::$onError = $callback;
    }

    public static function run(bool $caseSensitive = false)
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = $parsedUrl['path'] ?? '/';
        $path = urldecode($path);
        $reqMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if ($reqMethod == 'get') {
            self::handleRequest($path, self::$getMethodRoutes, $caseSensitive);
        } elseif ($reqMethod == 'post') {
            self::handleRequest($path, self::$postMethodRoutes, $caseSensitive);
        } else {
            self::handleRequest($path, self::$otherRoutes, $caseSensitive);
        }
    }

    public static function handleRequest(string $path, array $routes, bool $caseSensitive = false)
    {
        $pathMatch = false;
        $methodMatch = false;
        global $config;
        foreach ($routes as $route) {
            $expression = '#^' . $route['expression'] . '$#';

            if (!$caseSensitive) {
                $expression = $expression . 'i';
            }
            if (preg_match($expression, $path, $matches)) {
                $pathMatch = true;
                $rule = $route['rule'];
                if ($rule != null) {
                    if ($rule($matches) != true) {
                        return;
                    }
                }
                $requestCtrl = $route['route'] ?? $path;
                $requestCtrl = explode('/', trim($requestCtrl, "/"));
                $ctrl = $requestCtrl[0];
                $method = $requestCtrl[1] ?? '';
                $controllerName = ucfirst($ctrl) . "Controller";
                $controllerObj = new $controllerName();
                if (method_exists($controllerName, $method)) {
                    $controllerObj->$method($matches);
                    $methodMatch = true;
                }
                break;
            }
        }
        if (!$pathMatch) {
            if (self::$pathNotFound) {
                self::$pathNotAllowed();
                return;
            } elseif (isset($config['error_ctrl'])) {
                $controllerName = $config['error_ctrl'];
                if (file_exists($config['controller'])."/".$config['error_ctrl'].".php") {
                    if (method_exists($controllerName, 'pageNotFound')) {
                        (new $controllerName)->pageNotFound();
                        $methodMatch = true;
                        return;
                    }
                }
            }
            header('HTTP/1.1 404 Not Found');
            die('404 - The file  not found');
        }
        if (!$methodMatch) {
            if (self::$methodNotAllowed) {
                self::$methodNotAllowed();
                return;
            } elseif (isset($config['error_ctrl'])) {
                $controllerName = $config['error_ctrl'];
                if (file_exists($config['controller'])."/".$config['error_ctrl'].".php") {
                    if (method_exists($controllerName, 'invalidRequest')) {
                        (new $controllerName)->invalidRequest();
                        return;
                    }
                }
            }
            header('HTTP/1.1 400 Bad Request');
            die('404 - The method not allowed');
        }
    }

    public static function dispatch(string $path, string $method, bool $caseSensitive)
    {
        $method = strtolower($method);
        if ($method == 'get') {
            self::handleRequest($path, self::$getMethodRoutes, $caseSensitive);
        } elseif ($method == 'post') {
            self::handleRequest($path, self::$postMethodRoutes, $caseSensitive);
        } else {
            self::handleRequest($path, self::$otherRoutes, $caseSensitive);
        }
    }

    public static function error()
    {
        global $config;
        $data = func_get_args();
        if (self::$onError) {
            self::$onError($data);
            return;
        } elseif (isset($config['error_ctrl'])) {
            $controllerName = $config['error_ctrl'];
            if (file_exists($config['controller'])."/".$config['error_ctrl'].".php") {
                if (method_exists($controllerName, 'serverError')) {
                    (new $controllerName)->serverError($data);
                    return;
                }
            }
        }
        header('HTTP/1.1 500 Internal Server Error');
        die('500 - Server Error');
    }
}

<?php
/**
 * Route File Doc Comment
 * php version 7.3.5
 *
 * @category Route
 * @package  Route
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
/**
 * Route Class handles routing
 *
 * @category Route
 * @package  Route
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class Route
{
    /**
     * GET method Routes
     *
     * @var array
     */
    private static $_getMethodRoutes = [];

    /**
     * POST method routes
     *
     * @var array
     */
    private static $_postMethodRoutes = [];

    /**
     * Other method routes
     *
     * @var array
     */
    private static $_otherRoutes = [];

    private static $_methodNotAllowed = null;

    private static $_pathNotFound = null;

    private static $_onError = null;

    /**
     * Adds new Route
     *
     * @param string        $route      route
     * @param string|null   $expression execution value (controller/method)
     * @param string        $method     method Name
     * @param callable|null $filter     filter function
     *
     * @return void
     */
    public static function add(
        string $route,
        ?string $expression = null,
        string $method = Constants::METHOD_GET,
        ?callable $filter = null
    ) {
        $method = strtolower($method);
        if ($method == Constants::METHOD_GET) {
            array_push(
                self::$_getMethodRoutes,
                [ 'route' => $route, 'expression' => $expression,'rule' => $filter]
            );
        } elseif ($method == Constants::METHOD_POST) {
            array_push(
                self::$_postMethodRoutes,
                [ 'route' => $route, 'expression' => $expression,'rule' => $filter]
            );
        } else {
            array_push(
                self::$_otherRoutes,
                [ 'route' => $route, 'expression' => $expression,'rule' => $filter]
            );
        }
    }

    /**
     * Sets not allowed method
     *
     * @param callable $callback method
     *
     * @return void
     */
    public static function setMethodNotAllowed(callable $callback)
    {
        self::$_methodNotAllowed = $callback;
    }

    /**
     * Sets path not found method
     *
     * @param callable $callback method
     *
     * @return void
     */
    public static function setPathNotFound(callable $callback)
    {
        self::$_pathNotFound = $callback;
    }

    /**
     * Sets on error method
     *
     * @param callable $callback method
     *
     * @return void
     */
    public static function setOnError(callable $callback)
    {
        self::$_onError = $callback;
    }

    /**
     * Runs the current route
     *
     * @param boolean $caseSensitive does the URL is case sensitive or not
     *
     * @return void
     */
    public static function run(bool $caseSensitive = false)
    {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = $parsedUrl['path'] ?? '/';
        $path = urldecode($path);
        $reqMethod = strtolower($_SERVER['REQUEST_METHOD']);
        if ($reqMethod == Constants::METHOD_GET) {
            self::handleRequest($path, self::$_getMethodRoutes, $caseSensitive);
        } elseif ($reqMethod == Constants::METHOD_POST) {
            self::handleRequest($path, self::$_postMethodRoutes, $caseSensitive);
        } else {
            self::handleRequest($path, self::$_otherRoutes, $caseSensitive);
        }
    }

    /**
     * Handles the URL request
     *
     * @param string  $path          Requested URL path
     * @param array   $routes        Routes
     * @param boolean $caseSensitive Does the URL is case sensitive or not
     *
     * @return void
     */
    public static function handleRequest(
        string $path,
        array $routes,
        bool $caseSensitive = false
    ) {
        $pathMatch = false;
        $methodMatch = false;
        global $config;
        foreach ($routes as $route) {
            $routeUrl = '#^' . $route['route'] . '$#';

            if (!$caseSensitive) {
                $routeUrl = $routeUrl . 'i';
            }
            if (preg_match($routeUrl, $path, $matches)) {
                $pathMatch = true;
                $rule = $route['rule'];
                if ($rule != null) {
                    if ($rule($matches) != true) {
                        return;
                    }
                }
                array_shift($matches);
                $requestCtrl = $route['expression'] ?? $path;
                $requestCtrl = explode('/', trim($requestCtrl, "/"));
                $ctrl = $requestCtrl[0];
                $method = $requestCtrl[1] ?? '';
                $controllerName = ucfirst($ctrl) . "Controller";
                $controllerObj = new $controllerName();
                if (method_exists($controllerName, $method)) {
                    $controllerObj->$method(...$matches);
                    $methodMatch = true;
                }
                break;
            }
        }
        if (!$pathMatch) {
            if (self::$_pathNotFound) {
                self::$pathNotAllowed();
                return;
            } elseif (isset($config['error_ctrl'])) {
                $controllerName = $config['error_ctrl'];
                $file = $config['controller'] . "/" . $config['error_ctrl'].".php";
                if (file_exists($file)) {
                    if (method_exists($controllerName, 'pageNotFound')) {
                        (new $controllerName())->pageNotFound();
                        $methodMatch = true;
                        return;
                    }
                }
            }
            if (!headers_sent()) {
                header('HTTP/1.1 404 Not Found');
            }
            die('404 - The file not found');
        }
        if (!$methodMatch) {
            if (self::$_methodNotAllowed) {
                self::$_methodNotAllowed();
                return;
            } elseif (isset($config['error_ctrl'])) {
                $controllerName = $config['error_ctrl'];
                $file = $config['controller'] . "/" . $config['error_ctrl'] . ".php";
                if (file_exists($file)) {
                    if (method_exists($controllerName, 'invalidRequest')) {
                        (new $controllerName())->invalidRequest();
                        return;
                    }
                }
            }
            if (!headers_sent()) {
                header('HTTP/1.1 400 Bad Request');
            }
            die('404 - The method not allowed');
        }
    }

    /**
     * Dispatch the Request
     *
     * @param string  $path          Requested URL path
     * @param string  $method        Method Name
     * @param boolean $caseSensitive Does the URL is case sensitive or not
     *
     * @return void
     */
    public static function dispatch(
        string $path,
        string $method,
        bool $caseSensitive
    ) {
        $method = strtolower($method);
        if ($method == Constants::METHOD_GET) {
            self::handleRequest($path, self::$_getMethodRoutes, $caseSensitive);
        } elseif ($method == Constants::METHOD_POST) {
            self::handleRequest($path, self::$_postMethodRoutes, $caseSensitive);
        } else {
            self::handleRequest($path, self::$_otherRoutes, $caseSensitive);
        }
    }

    /**
     * Calls when an error occured
     *
     * @param string|null $data Error data
     * 
     * @return void
     */
    public static function error(?string $data = null)
    {
        global $config;
        if (self::$_onError) {
            ob_start();
            self::$_onError($data);
            $content = ob_get_clean();
            echo $content;
            exit();
        } elseif (isset($config['error_ctrl'])) {
            $controllerName = $config['error_ctrl'];
            $file = $config['controller'] . "/" . $config['error_ctrl'] . ".php";
            if (file_exists($file)) {
                if (method_exists($controllerName, 'serverError')) {
                    ob_start();
                    (new $controllerName())->serverError($data);
                    $content = ob_get_clean();
                    echo $content;
                    exit();
                }
            }
        }
        if (!headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        die('500 - Server Error');
        exit();
    }
}

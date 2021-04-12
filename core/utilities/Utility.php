<?php
//defined('VALID_REQ') OR exit('Not a valid Request');

class Utility
{
    public static function baseURL(): string
    {
        global $config;
        return $config['base_url'];
    }

    public static function setSessionData(string $key, ?string $value)
    {
        if ($value == null) {
            unset($_SESSION[$key]);
        } else {
            $value = base64_encode($value);
            $_SESSION[$key] = $value;
        }
    }

    public static function validateSession(string $key): bool
    {
        $value = (new InputData)->session($key);
        if ($value == null) {
            return false;
        }
        return true;
    }

    public static function redirectURL(string $url)
    {
        if (headers_sent() === false) {
            header('Location: ../' . $url, true, ($permanent === true) ? 301 : 302);
        }
        exit();
    }

    public static function endsWith($str, $endStr)
    {
        $len = strlen($endStr);
        if ($len == 0) {
            return true;
        }
        return (substr($str, -$len) === $endStr);
    }

    public static function startsWith($str, $startStr)
    {
        $len = strlen($startStr);
        return (substr($str, 0, $len) === $startStr);
    }

    public static function dispatch($url)
    {
        global $config;
        $url = ltrim($url, "/");
        $url = explode("/", $url);
        $controller = $url[0] . "Controller";
        $method = $url[1];
        if (file_exists($config['controller']) . "/" . $controller . ".php") {
            if (method_exists($controller, $method)) {
                (new $controller)->$method();
                exit();
            }
        }
        Route::error();
    }
}

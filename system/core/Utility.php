<?php
/**
 * Utility File Doc Comment
 * php version 7.3.5
 *
 * @category Utility
 * @package  Utility
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Not a valid Request');
/**
 * Utility Class offers various static functions
 *
 * @category Utility
 * @package  Utility
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
final class Utility
{
    /**
     * Returns the baseURL
     *
     * @return string
     */
    public static function baseURL(): string
    {
        global $config;
        return $config['base_url'];
    }

    /**
     * Set the session value with base64 encode
     *
     * @param string      $key   Key Name
     * @param string|null $value Value
     *
     * @return void
     */
    public static function setSessionData(string $key, ?string $value)
    {
        if ($value == null) {
            unset($_SESSION[$key]);
        } else {
            $value = base64_encode($value);
            $_SESSION[$key] = $value;
        }
    }

    /**
     * Checks whether the given key is exists in the Session array or not
     *
     * @param string $key Key Name
     *
     * @return boolean
     */
    public static function validateSession(string $key): bool
    {
        $value = (new InputData())->session($key);
        if ($value == null) {
            return false;
        }
        return true;
    }

    /**
     * Redirects to the passed URL
     *
     * @param string $url       URL
     * @param bool   $permanent Whether the URL is permanent or temporary
     * 
     * @return void
     */
    public static function redirectURL(string $url, $permanent = true)
    {
        if (!headers_sent()) {
            header('Location: ../' . $url, true, ($permanent === true) ? 301 : 302);
        }
        exit();
    }

    /**
     * Checks whether the string is ends with the given substring
     *
     * @param string $str    String
     * @param string $endStr Substring
     *
     * @return bool
     */
    public static function endsWith(string $str, string $endStr): bool
    {
        $len = strlen($endStr);
        if ($len == 0) {
            return true;
        }
        return (substr($str, -$len) === $endStr);
    }

    /**
     * Checks whether the string is starts with the given substring
     *
     * @param string $str      String
     * @param string $startStr Substring
     *
     * @return bool
     */
    public static function startsWith(string $str, string $startStr): bool
    {
        $len = strlen($startStr);
        return (substr($str, 0, $len) === $startStr);
    }

    /**
     * Performs Dispatch
     *
     * @param string $url URL
     *
     * @return void
     */
    public static function dispatch(string $url)
    {
        global $config;
        $url = ltrim($url, "/");
        $url = explode("/", $url);
        $controller = $url[0] . "Controller";
        $method = $url[1];
        if (file_exists($config['controller']) . "/" . $controller . ".php") {
            if (method_exists($controller, $method)) {
                (new $controller())->$method();
                exit();
            }
        }
        Route::error();
    }
}

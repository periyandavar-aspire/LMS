<?php
/**
 * Utility
 * php version 7.3.5
 *
 * @category Utility
 * @package  Core
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');
/**
 * Utility Class offers various static functions
 *
 * @category Utility
 * @package  Core
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
     * Set & unset the session data
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
            $_SESSION[$key] = $value;
        }
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
        !headers_sent() and
            header('Location: ../' . $url, true, ($permanent === true) ? 301 : 302);
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
}

<?php
/**
 * History Helper
 * php version 7.3.5
 *
 * @category   Helper
 * @package    Helper
 * @subpackage UrlHelper
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');

if (!function_exists("traceUser")) {
    /**
     * Stores last 7 accessed URL in cookies
     *
     * @return void
     */
    function traceUser()
    {
        global $config;
        $history = [];
        $cookieExpiration = $config['cookie_expiration'];
        $cookieName = "history";
        (isset($_COOKIE[$cookieName])) and
            $history = json_decode($_COOKIE[$cookieName], true);
        array_push(
            $history,
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
                ? "https"
                : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
        );
        if (count($history) > 7) {
            array_splice($history, 0, count($history)-7);
        }
        $history = json_encode($history);
        setcookie($cookieName, $history, time() + ($cookieExpiration), "/");
    }
}

if (!function_exists("getHistory")) {
    /**
     * Retrieve histories in cookies
     *
     * @return void
     */
    function getHistory()
    {
        $cookieName = "history";
        $history = (isset($_COOKIE[$cookieName]))
            ? json_decode($_COOKIE[$cookieName], true) : null;
        return $history;
    }
}

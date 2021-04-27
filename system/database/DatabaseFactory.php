<?php
/**
 * DatabaseFactory
 * php version 7.3.5
 *
 * @category DatabaseFactory
 * @package  Database
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
defined('VALID_REQ') or exit('Invalid request');
/**
 * Creates the instance of the database based on the DbConfig
 *
 * @category DatabaseFactory
 * @package  Database
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */
class DatabaseFactory
{
    private static $_db;

    /**
     * Creates and returns Database instance
     *
     * @return void
     */
    public static function create()
    {
        global $dbConfig;
        if (isset(self::$_db)) {
            return self::$_db;
        }
        $driver = explode("/", $dbConfig['driver']);
        $driverclass = $driver[0] . 'Driver';
        $driver = isset($driver[1]) ? $driver[1] : '';
        self::$_db = $driverclass::getInstance(
            $dbConfig['host'],
            $dbConfig['user'],
            $dbConfig['password'],
            $dbConfig['database'],
            $driver
        );
        return self::$_db;
    }
}

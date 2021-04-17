<?php
/**
 * DbConfig File all the configurations of the database are defined here
 * php version 7.3.5
 *
 * @category DbConfig
 * @package  DbConfig
 * @author   Periyandavar <periyandavar@gmail.com>
 * @license  http://license.com license
 * @link     http://url.com
 */

/**
 * Config keys and meanings
 * host - db host
 * user - db username
 * password - db password
 * database - database name
 * usepdo - set it true if need to establish pdo connection
 * driver - database driver name (ex: mysql)
 * prefix - database tables prefix
 */
$dbConfig = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'lms',
    'usepdo' => false,
    'driver' => 'mysql',
    'prefix' => ''
];

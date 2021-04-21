<?php
/**
 * Loader File
 * php version 7.3.5
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */

defined('VALID_REQ') or exit('Not a valid Request');

/**
 * Loader Class autoloads the files
 *
 * @category   Loader
 * @package    SYS
 * @subpackage Libraries
 * @author     Periyandavar <periyandavar@gmail.com>
 * @license    http://license.com license
 * @link       http://url.com
 */
class Loader
{
    /**
     * Loader class instance
     *
     * @var Loader|null $_instance
     */
    private static $_instance = null;

    /**
     * Instantiate the new Loader instance
     */
    public function __construct()
    {
        $this->_defaultRegister();
        $this->_autoloader();
        $this->loadAll('app/config/routes');
    }

    /**
     * Register new spl_autoload_register callback fucntion
     *
     * @param callable $callback Callback function
     *
     * @return void
     */
    public function regiterAutoload(callable $callback)
    {
        spl_autoload_register($callback);
    }

    /**
     * Loads the all files from autoloaded files list
     *
     * @return void
     */
    private function _autoloader()
    {
        global $autoload;
        foreach ($autoload as $file) {
            include_once $file;
        }
    }

    /**
     * Checks whether the class is loaded or not
     *
     * @param string $class Class Name
     *
     * @return string
     */
    public function isLoaded($class): bool
    {
        $loadedFiles = get_included_files();
        return in_array(ucfirst($class), $loadedFiles, true);
    }

    /**
     * Loads all php files from the specified directory
     *
     * @param string $dir Directory Name
     *
     * @return void
     */
    public function loadAll(string $dir)
    {
        foreach (glob("$dir/*.php") as $filename) {
            include $filename;
        }
    }

    /**
     * Sets Default autoload register
     *
     * @return void
     */
    private function _defaultRegister()
    {
        spl_autoload_register(
            function ($className) {
                $file = 'system/base/' . $className . ".php";
                if (file_exists($file)) {
                    include_once $file;
                }
            }
        );

        spl_autoload_register(
            function ($className) {
                $file = 'system/core/' . $className . ".php";
                if (file_exists($file)) {
                    include_once $file;
                }
            }
        );

        spl_autoload_register(
            function ($className) {
                global $config;
                if (Utility::endsWith(strtolower($className), 'controller')) {
                    $ctrlPath = $config['controller'];
                    $file = $ctrlPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'model')) {
                    $ModelPath = $config['model'];
                    $file = $ModelPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'service')) {
                    $ModelPath = $config['service'];
                    $file = $ModelPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'driver')) {
                    $DriverPath = 'system/database/driver/';
                    $file = $DriverPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                } elseif (Utility::endsWith(strtolower($className), 'view')) {
                    $ViewPath = $config['view'];
                    $file = $ViewPath . $className . ".php";
                    if (file_exists($file)) {
                        include_once $file;
                    }
                }
            }
        );
    }

    /**
     * Intialize the Loader class and returns load class object
     *
     * @return Loader
     */
    public static function intialize(): Loader
    {
        if (self::$_instance == null) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }
}
